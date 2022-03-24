<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $table = "product_store";
    protected $primaryKey = ['product_id', 'store_id'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
