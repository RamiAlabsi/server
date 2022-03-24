<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTypeTranslation extends Model
{
    use HasFactory;
    
    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }
}
