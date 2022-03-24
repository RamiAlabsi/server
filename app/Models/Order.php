<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function city()
    {
        return $this->belongsTo("App\Models\City");
    }

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function getMyItems()
    {
        $items = [];
        foreach ($this->items as $item) {
            if ($item->isOwner(Auth::user()->id)) {
                array_push($items, $item);
            }
        }
        return $items;
    }
}
