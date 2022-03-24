<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeAllowedValueTranslation extends Model
{
    use HasCompositePrimaryKeyTrait;
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = ["product_attribute_id", "language_id"];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('product_attribute_allowed_value_id', $this->getAttribute('product_attribute_allowed_value_id'))
            ->where('language_id', $this->getAttribute('language_id'));
    }

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }
}
