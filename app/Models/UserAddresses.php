<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_address';
    protected $guarded=[];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
     public function City(){
        return $this->belongsTo('App\Models\City','city_id');
    }

}