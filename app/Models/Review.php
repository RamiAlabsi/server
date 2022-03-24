<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function getRatePercentageAttribute(){
        return ($this->rate / 5) * 100;
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
