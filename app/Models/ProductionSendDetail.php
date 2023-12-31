<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionSendDetail extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }
    
    use HasFactory;
}
