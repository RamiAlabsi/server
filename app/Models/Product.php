<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="products";
    protected $guarded=[];
    // PRODUCT_CATEGORIES TABLE
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_categories');
    }
    public function getCategoryIdsAttribute()
    {
        $category_ids = [];
        foreach ($this->categories as $category) {
            array_push($category_ids, $category->id);
        }
        return $category_ids;
    }
    // PRODUCT_TRANSLATIONS TABLE
    public function translations()
    {
        return $this->hasMany('App\Models\ProductTranslation');
    }
    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale())
                return $translation;
        }
    }
    // PRODUCT_IMAGES TABLE
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    //getting the price with applying the discount
    public function getFinalPriceAttribute()
    {
        if ($this->discount_rate) {
            return $this->price - ($this->price * $this->discount_rate) / 100;
        }
        return $this->price;
    }

    //getting all product attributes
    public function attributes()
    {
        return $this->hasMany('App\Models\ProductAttribute');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store')->withTrashed();
    }

    public function getStoreAttribute()
    {
        return $this->stores[0];
    }

    public function getVendorAttribute()
    {
        $vendor = $this->store->users[0];
        return $vendor;
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review','product_id');
    }

    public function getRatePercentageAttribute()
    {
        return ($this->total_rate / 5) * 100;
    }

    public function showRate()
    {
        $minimumReviewsToShowRate = 1;
        if (count($this->reviews) < $minimumReviewsToShowRate)
            return false;
        return true;
    }
    //======product comments==================
    public function comments(){
        return $this->hasMany('App\Models\Comment','product_id')->where('status',1);
    }
}
