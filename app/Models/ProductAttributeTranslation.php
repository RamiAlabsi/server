<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductAttributeTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    public $timestamps = false;
    protected $primaryKey = ["product_attribute_id", "language_id"];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('product_attribute_id', $this->getAttribute('product_attribute_id'))
            ->where('language_id', $this->getAttribute('language_id'));
    }

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }
}
