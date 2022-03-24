<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_comments';
     protected $guarded=[];
    public function parent(){
        return $this->belongsTo('App\Models\Comment','parent_id');
    }
    public function Product(){
       return $this->belongsTo('App\Models\Product','product_id'); 
    }
    public function child(){
        return $this->hasMany('App\Models\Comment','parent_id')->where('status',1);
    }
     public function user(){
        return $this->belongsTo('App\Models\User','user_id');
     }
       public function username(){
        return $this->belongsTo('App\Models\User','user_id')->select('name');
     }

}
