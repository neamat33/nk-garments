<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionReceive extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(ProductionReceiveDetail::class,'production_receive_id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_to');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    protected $guarded = [];
}
