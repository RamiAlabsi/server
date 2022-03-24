<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartAttributeSelection extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function selected_attribute_allowed_value(){
        return $this->belongsTo('App\Models\ProductAttributeAllowedValue', 'product_attribute_allowed_value_id');
    }
}
