<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function translations()
    {
        return $this->hasMany('App\Models\OrderItemTranslation');
    }
    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale())
                return $translation;
        }
    }
    
    public function status(){
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function store(){
        return $this->belongsTo('App\Models\Store')->withTrashed();
    }

    public function isOwner($vendor_id)
    {
        foreach ($this->store->users as $owner) {
            if ($owner->id == $vendor_id)
                return true;
        }
        return false;
    }
}
