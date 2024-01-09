<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpProductionSend extends Model
{
    use HasFactory;
     
    public function items()
    {
        return $this->hasMany(TpProductionSendDetail::class,'tp_production_send_id');
    }
    public function send_items()
    {
        return $this->hasMany(TpProductionSendRawDetail::class,'tp_production_send_id');

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
