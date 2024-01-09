<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkSend extends Model
{
    use HasFactory;
    protected $table = "bulk_send";
    public function items()
    {
        return $this->hasMany(BulkSendDetail::class,'bulk_send_id');
    }
    protected $guarded = [];
}
