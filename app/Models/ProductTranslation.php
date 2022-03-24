<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $primaryKey = ["product_id", "language_id"];
    public $timestamps = false;

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
