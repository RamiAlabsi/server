<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemTranslation extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $primaryKey = ["order_item_id", "language_id"];
    public $timestamps = false;

    public function language()
    {
        $d = $this->belongsTo('App\Models\Language');
        return $d;
    }
}
