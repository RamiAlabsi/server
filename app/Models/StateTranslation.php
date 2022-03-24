<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;
    
    protected $primaryKey = ["state_id", "language_id"];
    public $timestamps = false;

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }
}
