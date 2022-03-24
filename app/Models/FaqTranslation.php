<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $primaryKey = ["faq_id", "language_id"];
    public $timestamps = false;

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }

    public function faq(){
        return $this->belongsTo('App\Models\faq');
    }
}
