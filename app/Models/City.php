<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = false;

    protected function translations()
    {
        $d = $this->hasMany('App\Models\CityTranslation');
        return $d;
    }
    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale())
                return $translation;
        }
    }
    public function state(){
        return $this->belongsTo('App\Models\State');
    }
}
