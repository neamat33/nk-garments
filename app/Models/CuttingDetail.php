<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingDetail extends Model
{
    protected $guarded = [];
    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }
    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }
    
    use HasFactory;
}
