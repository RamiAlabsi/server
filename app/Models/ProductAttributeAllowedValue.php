<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeAllowedValue extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected function translations()
    {
        return $this->hasMany('App\Models\ProductAttributeAllowedValueTranslation');
    }

    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale()) 
                return $translation;
        }
    }

    public function product_attribute(){
        return $this->belongsTo('App\Models\ProductAttribute');
    }
}
