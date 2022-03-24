<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavourite extends Model
{
    use HasFactory;

    public function productWithTrashed(){
        return $this->belongsTo('App\Models\Product', 'product_id')->withTrashed();
    }
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
