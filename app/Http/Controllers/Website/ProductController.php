<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Product;
use App\Models\Review;
use App\Models\UserFavourite;
use App\Models\UserOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search_text = request()->has('search_text') ? request('search_text') : "";
        $category_id = request()->has('category_id') ? request('category_id') : "";
        $discount_rate = request()->has('discount_rate') ? request('discount_rate') : "";

        $input = array(
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false,
            "search_text" => $search_text,
            "category_id" => $category_id,
            "discount_rate" => $discount_rate
        );
        return view('website.products.index', $input);
    }

    public function getCategoriesSelectOptions($category)
    {
        if ($category->hasChildren() == false)
            return "<option value='$category->id'>" . $category->translation->name . "</option>";

        $children = "";
        if ($category->translation != null)
            $children = "<optgroup label='" . $category->translation->name . "'>";
        foreach ($category->children as $child) {
            if ($child->id == $category->id)
                continue;
            $children .= $this->getCategoriesSelectOptions($child);
        }
        if ($category->translation != null)
            $children .= "</optgroup>";
        return $children;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $with_trashed = 0)
    {
        $user_favourites = UserFavourite::all();
        $user_favourite_products = array();
        foreach ($user_favourites as $user_favourite) {
            array_push($user_favourite_products, $user_favourite->product_id);
        }

        $product = Product::find($id);
        if ($with_trashed == 1)
            $product = Product::withTrashed()->find($id);
        // dd($product);
        $cart_item = [];
        if (Auth::user() != null)
            $cart_item = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $product->id)->first();
        $related_products = [];
        $unique_product_ids = [];
        foreach ($product->categories as $category) {
            foreach ($category->product_categories as $product_category) {
                $dummy_product = $product_category->product;

                if ($dummy_product == null || in_array($dummy_product->id, $unique_product_ids) || $dummy_product->id == $product->id)
                    continue;
                array_push($related_products, $dummy_product);
                if (count($related_products) >= 5)
                    break;
                array_push($unique_product_ids, $dummy_product->id);
            }
        }

        $input = array(
            "user_favourite_products" => $user_favourite_products,
            "popup" => false,
            "loader" => true,
            "breadcrumb" => false,
            "subscribe_newsletter" => false,
            "product" => $product,
            "cart_item" => $cart_item,
            "related_products" => $related_products
        );
        return view('website.products.show', $input);
    }

    public function makeRequest(Request $request, $id)
    {
        $product = Product::find($id);
        $other_peer = $product->stores[0]->users[0]->id;

        //saving the user_offer
        $user_offer = new UserOffer;
        $user_offer->quantity = $request->qty;
        $user_offer->requested_price = $request->request_price;
        $user_offer->status = 0;
        $user_offer->product_id = $product->id;
        $user_offer->user_id = Auth::user()->id;
        $user_offer->save();

        //creating a conversation if it doesn't exist
        $query1 = "peer2_id = $other_peer and peer1_id = " . $user_offer->user_id;
        $query2 = "peer1_id = $other_peer and peer2_id = " . $user_offer->user_id;
        $conversation = Conversation::whereRaw($query1 . " or " . $query2)->get();
        if (count($conversation) == 0) {
            $conversation = new Conversation;
            $conversation->peer1_id = $user_offer->user_id;
            $conversation->peer2_id = $other_peer;
            $conversation->save();
        } else
            $conversation = $conversation[0];

        // sending a new message
        $conversation_message = new ConversationMessage;
        $conversation_message->message = "I want to buy $user_offer->quantity items of {$product->translation->name} product with only the price of $user_offer->requested_price, product_url: " . url("/products/$product->id");
        $conversation_message->conversation_id = $conversation->id;
        $conversation_message->peer1_to_peer2 = $conversation->peer1_id == $user_offer->user_id;

        $conversation_message->file_type = 2;
        $conversation_message->file_url = $product->images[0]->image_url;

        $conversation_message->save();

        return redirect('/chat');
    }

    public function leaveReview($product_id)
    {
        $user = Auth::user();
        if ($user == null || Product::find($product_id) == null)
            return;

        $review = new Review;
        $review->product_id = $product_id;
        $review->user_id = $user->id;
        $review->text = request('text');
        $review->rate = request('rating');
        if (count(Review::where('user_id', $review->user_id)->where('product_id', $review->user_id)->get()) > 0)
            return redirect()->back()->with(['alert' => [
                'icon' => 'error',
                'title' => __('lang.alert_error'),
                'text' => __('lang.alert_reviewed_before')
            ]]);
        $review->save();
        return redirect()->back()->with(['alert' => [
            'icon' => 'success',
            'title' => __('lang.alert_congrats'),
            'text' => __('lang.alert_success')
        ]]);
    }
}
