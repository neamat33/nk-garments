<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 
class purchase extends Model
{
    use HasFactory;

    protected $table="purchases";
 
    protected $guarded=[];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class,'purchase_id');
    }

    public function receive_challan()
    {
        return $this->hasMany(ReceiveChallan::class,'purchase_id');
    }

    public function purchase_return()
    {
        return $this->hasMany(PurchaseReturn::class,'purchase_id');
    }
    
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function purchase_by_employee(){
        return $this->belongsTo(Employee::class,'purchase_by')->withDefault([
            'employee_name' => '',
        ]);
    }

    public function department(){
        return $this->belongsTo(Department::class)->withDefault([
            'name' => '',
        ]);
    }

    public function update_return(){
        $return_qty= $this->purchase_return()->sum('return_qty');  
        $return_amount= $this->purchase_return()->sum('return_amount');

         $this->update([
            'returned_amount' =>$return_amount,
            'returned_qty' => $return_qty,
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
        $delivery=$this->items()->sum('delivery_qty');
        $due= $total - $delivery;

        $this->items->each(function ($Item) {
            $Item->update_delivery_qty();
        });

        $this->update([
            'total_qty' => $total,
            'delivery_qty' => $delivery,
            'due_qty' => $due,
            // 'delivery_status' => $d_status,
        ]);
    }

    public function update_calculated_amount(){
        // update paid
        $this->update_return();
        $this->update_paid();
        $this->update_delivery_qty();

         $this->items->each(function ($Item) {
            $Item->update_calculated_data();
        });

        $total=$this->items()->sum('sub_total');
        
        $final_payable=$total - $this->returned_amount;
        
        $this->update([
            'final_payable' => $final_payable,
        ]);

        $due = $this->final_payable - $this->paid;

        $this->update([
            'due' => $due,
        ]);
    }

    public function update_status(){
        if($this->returned_amount == $this->payable ){
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

    public function update_calculated_data(){
        $this->update_calculated_amount();
        $this->update_status();    
    }

    public function filter($request, $purchases)
    {
        if ($request->party_id != null) {
            $purchases = $purchases->where('party_id', $request->party_id);
        }

        if ($request->purchase_form != null) {
            $purchases = $purchases->where('purchase_form', $request->purchase_form);
        }

        if ($request->phone != null) {
            $purchases = $purchases->where('phone', $request->phone);
        }

        if ($request->purchase_by != null) {
            $purchases = $purchases->where('purchase_by', $request->purchase_by);
        }

        if ($request->department != null) {
            $purchases = $purchases->where('department_id', $request->department);
        }

        if ($request->has('purchase_date')) {
            $dateRange = explode(' - ', $request->input('purchase_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $purchases = $purchases->whereBetween('purchase_date', [$startDate, $endDate]);
            }
        }

        if ($request->has('delivery_date')) {
            $dateRange = explode(' - ', $request->input('delivery_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $purchases = $purchases->whereBetween('delivery_date', [$startDate, $endDate]);
            }
        }

        return $purchases;
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
             $relationMethods = ['receive_challan'];
 
             foreach ($relationMethods as $relationMethod) {
                 if ($rel->$relationMethod()->count() > 0) {
                     return false;
                 }
             }
         });
     }
    

}
