<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    protected function translations()
    {
        $d = $this->hasMany('App\Models\CategoryTranslation');
        return $d;

        //UPCOMING IS A DESCRIPTION OF THE ORM RELATIONS////////////////////////////////////////////////////////////////////////////
        //NOTE: Before you begin you should put in mind that the model that has the foreign key is called the child

        //ONE TO MANY
        //return $this->belongsTo('ParentModelName') //you are calling from the child
        //return $this->hasMany('ChildModelName') //you are calling from the parent

        //ONE TO ONE
        //return $this->hasOne('ParentModelName');

        //MANY TO MANY
        //return $this->belongsToMany('ParentsModelName', 'pivot_table_name')

        //COMPLEX
        //return $this->hasManyThrough('FarChildModelName', 'ImmediateChildModelName', 'immediate_foreign_key', 'far_foreign_key');
        /*
            //in the Model with the type variable
            return $this->morphTo()

            //in the Model types
            return $this->morphMany('ModelWithTypeVariable')
        */
    }
    public function getTranslationAttribute()
    {
        foreach ($this->translations as $translation) {
            $my_locale = $translation->language->locale;
            if ($my_locale == app()->getLocale())
                return $translation;
        }
    }

    public function _parent()
    {
        $d = $this->belongsTo('App\Models\Category', 'parent_id');
        return $d;
    }
    public function hasParent()
    {
        if ($this->parent_id == $this->id)
            return false;
        return true;
    }
    protected function getAllParents($category)
    {
        $allParents = [];
        if ($category->hasParent()) {
            $allParents = $this->getAllParents($category->_parent);
        }
        array_push($allParents, $category);
        return $allParents;
    }
    public function getAllParentsAttribute()
    {
        if ($this->hasParent())
            return $this->getAllParents($this->_parent);
        return [];
    }
    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
    public function hasChildren()
    {
        $childrenCount = count($this->children);
        return $childrenCount > 0 ? true : false;
    }

    public function product_categories()
    {
        return $this->hasMany("App\Models\ProductCategory");
    }

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'product_categories');
    }

    public function sales(){
        return $this->hasMany('App\Models\CategorySale');
    }
}
