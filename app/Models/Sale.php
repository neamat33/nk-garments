<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class Sale extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function sale_return()
    {
        return $this->hasMany(SaleReturn::class,'sale_id');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function sold_by_employee(){
        return $this->belongsTo(Employee::class,'sold_by')->withDefault([
            'employee_name' => '',
        ]);
    }

      public function update_return(){
        $return_commission= $this->sale_return()->sum('return_commission');
        $return_discount= $this->sale_return()->sum('return_discount');
        $return_amount= $this->sale_return()->sum('return_amount');
        $return_qty= $this->sale_return()->sum('return_qty');  

         $this->update([
            'returned_discount' =>$return_discount,
            'returned_commission'=>$return_commission,
            'returned_amount' =>$return_amount,
            'returned_qty' => $return_qty,
        ]);
    }

    public function update_commission()
    {
        // $commission=$this->items()->sum('commission') - $this->returned_commission;
        $commission=$this->total_commission;
        $this->update([
            'total_commission' => $commission
        ]);
    }

    public function update_paid()
    {
        $this->update([
            'paid' => $this->payments()->sum('amount')
        ]);
    }

    public function update_delivery_qty()
    {
        $total = $this->items()->sum('qty') - $this->returned_qty;
 
        $this->update([
            'total_qty' => $total,
        ]);

    }

    public function update_calculated_amount(){
        // update paid
        $this->update_return();
        $this->update_paid(); 
        $this->update_delivery_qty();       
        $this->update_commission();
        
        $total=$this->items()->sum('sub_total') - $this->total_commission - $this->total_discount;
        $final_receivable=$total - $this->returned_amount;
        
        $this->update([
            'receivable' =>$total,
            'final_receivable' => $final_receivable,
        ]);

        $due = $this->final_receivable - $this->paid;

         $this->update([
            'due' => $due,
        ]);
    }

    public function update_status(){
        if($this->returned_amount == $this->receivable ){
            $d_status="Full Return";
        }elseif($this->due_qty <= 0){
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
        if ($request->customer_name != null) {
            $sales = $sales->where('customer_name', 'like', '%' . $request->customer_name . '%');
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

    public static function boot()
    {
        parent::boot();

        static::deleting(function($sales){
            foreach ($sales->items as $item) {
                $item->delete();
            }
        });
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

}
