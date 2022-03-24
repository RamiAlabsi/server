<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CategoryTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;
    
    protected $primaryKey = ["category_id", "language_id"];
    public $timestamps = false;

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }
}
