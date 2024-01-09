<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkSendDetail extends Model
{
    protected $guarded = [];
    protected $table = "bulk_send_detail";
    public function bulksend()
    {
        return $this->belongsTo(BulkSend::class, 'bulk_send_id');
    }
    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }
    
    use HasFactory;
}
