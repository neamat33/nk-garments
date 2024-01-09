<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class PartySaleCommission extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(PartySaleCommissionItem::class,'party_sale_commission_id');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function update_qty(){
         $total_qty = $this->items()->sum('total_qty');

         $this->update([
            'total_qty' => $total_qty,
        ]);
    }

    public function update_invoice(){
         $total_invoice = $this->items()->count();

         $this->update([
            'total_invoice' => $total_invoice,
        ]);
    }

    public function update_total_commission(){
        $total_commission = $this->items()->sum('total_commission');

         $this->update([
            'total_commission' => $total_commission,
        ]);
    }

    public function update_calculated_data(){
        $this->update_qty();
        $this->update_invoice();
        $this->update_total_commission();

        $this->items->each(function ($item) {
            $item->update_calculated_data();
        });
    }

    public function filter($request, $sales_commissions)
    {
        if ($request->party_id != null) {
            $sales_commissions = $sales_commissions->where('party_id', $request->party_id);
        }

        if ($request->has('commission_date')) {
            $dateRange = explode(' - ', $request->input('commission_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sales_commissions = $sales_commissions->whereBetween('commission_date', [$startDate, $endDate]);
            }
        }

        return $sales_commissions;
    }
    

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($sales_commission) {
            // Get related items and delete them
            $items = $sales_commission->items;
            foreach ($items as $item) {
                $item->delete();
            }
            // Update calculated data after deleting items
            foreach ($items as $item) {
                $item->update_calculated_data();
            }
        });
    }



}
