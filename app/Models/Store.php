<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected function translations()
    {
        return $this->hasMany('App\Models\StoreTranslation');
    }

    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale())
                return $translation;
        }
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'user_stores');
    }
     public function store_product(){
         return $this->hasMany('App\Models\ProductStore','store_id');
     }
    public function products(){
        return $this->belongsToMany('App\Models\Product');
    }
    public function products_with_trashed(){
        return $this->belongsToMany('App\Models\Product')->withTrashed();
    }
}
