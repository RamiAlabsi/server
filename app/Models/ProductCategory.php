<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $primaryKey = ['product_id', 'category_id'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
