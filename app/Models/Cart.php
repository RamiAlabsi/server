<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cart';

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function attribute_selections(){
        return $this->hasMany('App\Models\CartAttributeSelection');
    }
}
