<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function cats(){
        return $this->hasMany('App\Models\cat_setting','setting_id');
    }
}
