<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class PartySalePayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(Payment::class,'party_sale_payment_id');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function account()
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }

    public function update_invoice(){
        $total_invoice = $this->items()->count();

        $this->update([
           'total_invoice' => $total_invoice,
       ]);
   }

   public function update_calculated_data(){
        $this->update_invoice();

        $this->items->each(function ($item) {
            if ($item->partySale) {
                $item->partySale->update_calculated_data();
            }
        });
    }

    public function filter($request, $sale_payments)
    {
        if ($request->party_id != null) {
            $sale_payments = $sale_payments->where('party_id', $request->party_id);
        }

        if ($request->bank_account != null) {
            $sale_payments = $sale_payments->where('bank_account_id', $request->bank_account);
        }

        if ($request->has('payment_date')) {
            $dateRange = explode(' - ', $request->input('payment_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sale_payments = $sale_payments->whereBetween('payment_date', [$startDate, $endDate]);
            }
        }

        return $sale_payments;
    }
    

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($sales_payment) {
            // Get related items and delete them
            $items = $sales_payment->items;
            foreach ($items as $item) {
                $item->delete();
            }
            // Update calculated data after deleting items
            foreach ($items as $item) {
                $item->partySale->update_calculated_data();
            }
        });
    }

}
