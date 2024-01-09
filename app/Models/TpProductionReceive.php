<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpProductionReceive extends Model
{
    use HasFactory;
     
    public function items()
    {
        return $this->hasMany(TpProductionReceiveDetail::class,'tp_production_receive_id');
    }

    public function send()
    {
        return $this->belongsTo(TpProductionSend::class,'tp_production_send_id');

    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function party()
    {
        return $this->belongsTo(Party::class,'party_id');
    }

    protected $guarded = [];
}
