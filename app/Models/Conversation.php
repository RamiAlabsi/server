<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;
    public function messages(){
        return $this->hasMany('App\Models\ConversationMessage');
    }
    public function getLatestMessagesAttribute(){
        return $this->messages->sortByDesc('created_at');
    }
    public function peer1(){
        return $this->belongsTo('App\Models\User');
    }
    public function peer2(){
        return $this->belongsTo('App\Models\User');
    }
    public function getOtherPeerAttribute(){
        if($this->peer1_id == Auth::user()->id){
            return $this->peer2;
        }
        return $this->peer1;
    }
    static public function findUsingPeers($peer1_id, $peer2_id){
        $query1 = "peer2_id = $peer1_id and peer1_id = " . $peer2_id;
        $query2 = "peer1_id = $peer1_id and peer2_id = " . $peer2_id;
        $conversation = Conversation::whereRaw($query1 . " or " . $query2)->get();
        return $conversation;
    }
}
