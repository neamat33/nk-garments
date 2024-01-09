<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutting extends Model
{
    use HasFactory;
     
    public function items()
    {
        return $this->hasMany(CuttingDetail::class,'cutting_id');
    }
    public function raw_items()
    {
        return $this->hasMany(CuttingRawDetail::class,'cutting_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_to');
    }

    protected $guarded = [];
}
