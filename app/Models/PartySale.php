<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 
class PartySale extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function items()
    {
        return $this->hasMany(PartySaleItem::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function delivery_challan()
    {
        return $this->hasMany(DeliveryChallan::class,'party_sale_id');
    }

    public function order_by_employee(){
        return $this->belongsTo(Employee::class,'order_by')->withDefault([
            'employee_name' => '',
        ]);
    }

    public function sold_by_employee(){
        return $this->belongsTo(Employee::class,'sold_by')->withDefault([
            'employee_name' => '',
        ]);
    }

    public function update_paid()
    {
        $this->update([
            'paid' => $this->payments()->sum('amount')
        ]);
    }

    public function update_commission()
    {
        $this->update([
            'total_commission' => $this->items()->sum('commission')
        ]);
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }
    
    public function update_delivery_qty()
    {
        $total = $this->items()->sum('qty');
        $delivery=$this->items()->sum('delivery_qty');
        $due= $total - $delivery;

        if($due <= 0){
            $d_status="Delivered";
        }else{
            $d_status="Not Delivered";
        }

        $this->items->each(function ($Item) {
            $Item->update_delivery_qty();
        });

        $this->update([
            'total_qty' => $total,
            'delivery_qty' => $delivery,
            'due_qty' => $due,
            'delivery_status' => $d_status,
        ]);

    }

    public function update_calculated_data()
    {
        // update paid
        $this->update_paid();
        $this->update_delivery_qty();
        $this->update_commission();
        
        $this->items->each(function ($Item) {
            $Item->update_calculated_data();
        });

        $final_receivable=$this->final_receivable - $this->returned;
        
        $this->update([
            'final_receivable' => $final_receivable,
        ]);

        $due = $this->final_receivable  -$this->paid;

        if($due < 0){
            $status="Paid";
        }else{
            $status="Unpaid"; 
        }
        // update_due
        $this->update([
            'due' => $due,
            'payment_status' => $status,
        ]);
    }

    public function filter($request, $sales)
    {
        if ($request->party_id != null) {
            $sales = $sales->where('id', $request->party_id);
        }

        if ($request->showroom != null) {
            $sales = $sales->where('showroom', $request->showroom);
        }

        if ($request->sold_by != null) {
            $sales = $sales->where('sold_by', $request->sold_by);
        }

        if ($request->order_by != null) {
            $sales = $sales->where('order_by', $request->order_by);
        }

        if ($request->has('sale_date')) {
            $dateRange = explode(' - ', $request->input('sale_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sales = $sales->whereBetween('sale_date', [$startDate, $endDate]);
            }
        }

        if ($request->has('delivery_date')) {
            $dateRange = explode(' - ', $request->input('delivery_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sales = $sales->whereBetween('delivery_date', [$startDate, $endDate]);
            }
        }

        return $sales;
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    // Don't delete if any relation is existing
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($rel) {
            $relationMethods = ['delivery_challan'];

            foreach ($relationMethods as $relationMethod) {
                if ($rel->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }

}
