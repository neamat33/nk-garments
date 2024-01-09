<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartySaleCommissionItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function sale()
    {
        return $this->belongsTo(PartySale::class,'party_sale_id');
    }

    public function update_calculated_data(){
        $this->sale->update_calculated_data();
    }
    
}
