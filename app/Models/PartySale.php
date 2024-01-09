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

    public function party_sale_return()
    {
        return $this->hasMany(PartySaleReturn::class,'party_sale_id');
    }

    public function commission_items()
    {
        return $this->hasMany(PartySaleCommissionItem::class,'party_sale_id');
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

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function update_return(){
        $return_qty= $this->party_sale_return()->sum('return_qty');  
        $return_commission= $this->party_sale_return()->sum('return_commission');
        $returned_discount= $this->party_sale_return()->sum('return_discount');
        $return_amount= $this->party_sale_return()->sum('return_amount');

        $this->update([
            'returned_commission'=>$return_commission,
            'returned_discount' =>$returned_discount,
            'returned_amount' =>$return_amount,
            'returned_qty' => $return_qty,
        ]);
    }

    public function update_commission()
    {
        $add_commission =$this->commission_items()->sum('total_commission');
        $total_commission=$this->sale_commission + $add_commission;
        $this->update([
            'add_commission' =>$add_commission,
            'total_commission' => $total_commission,
        ]);
    }
    
    public function update_paid()
    {
        $this->update([
            'paid' => $this->payments()->sum('amount'),
            'payment_discount' => $this->payments()->sum('discount'),
        ]);
    }
    
    public function update_delivery_qty()
    {
        $total = $this->items()->sum('qty') - $this->returned_qty;
        $delivery=$this->items()->sum('delivery_qty');
        $due= $total - $delivery;

        $this->items->each(function ($Item) {
            $Item->update_delivery_qty();
        });

        $this->update([
            'total_qty' => $total,
            'delivery_qty' => $delivery,
            'due_qty' => $due,
        ]);

    }

    public function update_calculated_amount()
    {
        // update paid
        $this->update_return();
        $this->update_commission();
        $this->update_paid();
        $this->update_delivery_qty();

        $this->items->each(function ($Item) {
            $Item->update_calculated_data();
        });

        $total=$this->items()->sum('sub_total') - $this->total_commission - $this->total_discount;
        $final_receivable=$total - $this->returned_amount - $this->payment_discount;
        
        $this->update([
            'receivable' =>$total,
            'final_receivable' => $final_receivable,
        ]);

        $due = $this->final_receivable  -$this->paid;

        // update_due
        $this->update([
            'due' => $due,
        ]);
    }

    public function update_status(){
        if($this->returned_amount == $this->receivable ){
            $d_status="Full Return";
        }elseif($this->due_qty  <= 0){
            $d_status="Delivered";
        }else{
            $d_status="Not Delivered";
        }

        if($this->due <= 0){
            $status="Paid";
        }else{
            $status="Unpaid"; 
        }

        $this->update([
            'delivery_status' => $d_status,
            'payment_status' => $status,
        ]);
    }

    public function update_calculated_data()
    {
        $this->update_calculated_amount();
        $this->update_status();    
    }
    

    public function filter($request, $sales)
    {
        if ($request->party_id != null) {
            $sales = $sales->where('party_id', $request->party_id);
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
