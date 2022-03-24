<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\UserOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $auth_user_id = Auth::user()->id;
        $conversations = Conversation::where('peer1_id', $auth_user_id)
            ->orWhere('peer2_id', $auth_user_id)->get();
        return view('website.chat.index', compact('conversations'));
    }

    public function show($conversation_id)
    {
        $conversation = Conversation::find($conversation_id);
        // dd(ConversationMessage::first()->sender);
        // dd(Carbon::parse(ConversationMessage::first()->created_at)->format('h:i'));
        return view('website.chat.show', compact('conversation'));
    }

    public function userOfferChat($id)
    {
        $user_offer = UserOffer::find($id);

        //getting vendor id to chat with
        // $product = $user_offer->product;
        // $vendor = $product->stores[0]->users[0];

        $conversation = Conversation::findUsingPeers(
            $user_offer->user_id,
            Auth::user()->id
        );
        return view('website.chat.user_offer_chat', compact('conversation', 'user_offer'));
    }

    public function send(Request $request)
    {
        dd(request());
        // getting the conversation
        $auth_user_id = Auth::user()->id;
        $conversation = Conversation::findUsingPeers($request->peer_id, $auth_user_id)[0];

        // initiating a new message and storing it
        $conversation_message = new ConversationMessage;
        $conversation_message->message = $request->txt;
        $conversation_message->conversation_id = $conversation->id;
        $conversation_message->peer1_to_peer2 = $conversation->peer1_id == $auth_user_id;
        if (request()->hasFile('image')) {
            $conversation_message->file_type = 2;
            $image = $request->image;
            $image_new_name = time() . rand(10, 1000000) . '.' . $image->extension();
            $image->move(public_path('/storage/images_uploaded'), $image_new_name);
            $conversation_message->file_url = 'public/storage/images_uploaded/' . $image_new_name;
        } elseif (request()->hasFile('file')) {
            $conversation_message->file_type = '1';
            $file = $request->file;
            $file_new_name = time() . rand(10, 1000000) . '.' . $file->extension();
            $file->move(public_path('/storage/files_uploaded'), $file_new_name);
            $conversation_message->file_url = 'public/storage/files_uploaded/' . $file_new_name;
            $conversation_message->file_name = $file->getClientOriginalName();
        }
        $conversation_message->save();

        $messages = array($conversation_message);
        $is_peer1 = $auth_user_id == $conversation->peer1_id ? 1 : 0;
        $other_peer_image = $conversation->other_peer->image;
        return view('website.chat.index_conversation', compact('messages', 'is_peer1', 'other_peer_image'));
    }

    public function load($other_peer_id)
    {
        $auth_user_id = Auth::user()->id;
        $conversation = Conversation::findUsingPeers($other_peer_id, $auth_user_id)[0];

        $messages = $conversation->messages->sortBy('created_at');
        // $latest_messages = $conversation->latest_messages->splice(0, 10)->sortBy('created_at');
        $is_peer1 = $auth_user_id == $conversation->peer1_id ? 1 : 0;
        $other_peer_image = $conversation->other_peer->image;
        // return File::size(public_path("storage/files_uploaded/161407669799132.jpg"));
        return view('website.chat.index_conversation', compact('messages', 'is_peer1', 'other_peer_image'));
    }
}
