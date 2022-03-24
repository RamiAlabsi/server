<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected function translations()
    {
        return $this->hasMany('App\Models\AttributeTypeTranslation');
    }

    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale())
                return $translation;
        }
    }
}
