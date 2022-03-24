<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    use HasFactory;

    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation');
    }

    public function getSenderAttribute()
    {
        $peer_col_name = $this->peer1_to_peer2 == 1 ? "peer1" : "peer2";
        return $this->conversation->$peer_col_name;
    }
}
