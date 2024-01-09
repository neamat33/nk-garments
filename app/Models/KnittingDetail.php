<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnittingDetail extends Model
{
    protected $guarded = [];
    protected $table = "knitting_detail";
    public function bulksend()
    {
        return $this->belongsTo(Knitting::class, 'knitting_id');
    }
    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }
    
    use HasFactory;
}
