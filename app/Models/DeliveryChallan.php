<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class DeliveryChallan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sale()
    {
        return $this->belongsTo(PartySale::class,'party_sale_id');
    }

    public function items()
    {
        return $this->hasMany(DeliveryChallanItem::class,'delivery_challan_id');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function order_by_employee(){
        return $this->belongsTo(Employee::class,'order_by')->withDefault([
            'employee_name' => '',
        ]);
    }

    public function dispatched_by_employee(){
        return $this->belongsTo(Employee::class,'dispatched_by')->withDefault([
            'employee_name' => '',
        ]);
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($challan) {
            $challan->sale->update_calculated_data();
        });

        static::deleting(function ($challan) {
            foreach ($challan->items as $item) {
                $item->delete();
            }
        });
    }
}
