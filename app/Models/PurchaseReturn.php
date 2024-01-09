<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class PurchaseReturn extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(PurchaseReturnItem::class,'purchase_return_id');
    }

    public function purchase()
    {
        return $this->belongsTo(purchase::class,'purchase_id');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function purchase_items()
    {
        return $this->belongsTo(PurchaseItem::class,'purchase_item_id');
    }

    public function update_calculated_amount(){
        $return_qty=$this->items()->sum('qty');
        $return_amount=$this->items()->sum('sub_total');

        $this->update([
            'return_qty'        => $return_qty,
            'return_amount'     => $return_amount,
        ]);
    }

    public function update_calculated_data()
    {
        $this->update_calculated_amount();
        $this->purchase->update_calculated_data();
    }

    public function filter($request, $purchase_returns)
    {
        if ($request->party_id != null) {
            $purchase_returns = $purchase_returns->where('party_id', $request->party_id);
        }

        if ($request->has('purchase_date')) {
            $dateRange = explode(' - ', $request->input('purchase_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $purchase_returns = $purchase_returns->whereBetween('purchase_date', [$startDate, $endDate]);
            }
        }

        if ($request->has('return_date')) {
            $dateRange = explode(' - ', $request->input('return_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $purchase_returns = $purchase_returns->whereBetween('return_date', [$startDate, $endDate]);
            }
        }

        if ($request->purchase_form != null) {
            $purchase_returns = $purchase_returns->where('purchase_form', $request->purchase_form);
        }

        if ($request->phone != null) {
            $purchase_returns = $purchase_returns->where('phone', $request->phone);
        }

        return $purchase_returns;
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($purchases) {
            $purchases->purchase->update_calculated_data();
        });

        static::deleting(function ($returns) {
            foreach ($returns->items as $item) {
                $item->delete();
            }
        });
    }
}
