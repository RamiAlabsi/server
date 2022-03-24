<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_setting extends Model
{
    use HasFactory;
    protected $table="setting_category";
    protected $guarded=[];
    public function Cat(){
        return $this->belongsTo('App\Models\Category','cat_id');
    }
}
