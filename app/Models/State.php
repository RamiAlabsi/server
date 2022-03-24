<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected function translations()
    {
        $d = $this->hasMany('App\Models\StateTranslation');
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
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function cities(){
        return $this->hasMany('App\Models\City');
    }
}
