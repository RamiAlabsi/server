<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected function translations()
    {
        return $this->hasMany('App\Models\ProductAttributeTranslation');
    }

    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale()) 
                return $translation;
        }
    }

    public function attribute_type()
    {
        return $this->belongsTo('App\Models\AttributeType');
    }

    public function allowed_values(){
        return $this->hasMany('App\Models\ProductAttributeAllowedValue');
    }
}
