<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class SaleReturn extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function sale()
    {
        return $this->belongsTo(Sale::class,'sale_id');
    }

    public function sale_items()
    {
        return $this->belongsTo(SaleItem::class,'sale_item_id');
    }

    public function items()
    {
        return $this->hasMany(SaleReturnItem::class,'sale_return_id');
    }

    public function update_calculated_amount(){
        $return_qty=$this->items()->sum('qty');
        // $return_commission=$this->items()->sum('commission');
        $return_amount=$this->items()->sum('sub_total') - $this->return_commission - $this->return_discount;

        $this->update([
            'return_qty'        => $return_qty,
            // 'return_commission' => $return_commission,
            'return_amount'     => $return_amount,
        ]);
    }

    public function update_calculated_data()
    {
        $this->update_calculated_amount();
        $this->sale->update_calculated_data();
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public function filter($request, $sale_returns)
    {
        if ($request->customer_name != null) {
            $sale_returns = $sale_returns->where('customer_name', $request->customer_name);
        }

        if ($request->phone != null) {
            $sale_returns = $sale_returns->where('phone', $request->phone);
        }

        if ($request->has('sale_date')) {
            $dateRange = explode(' - ', $request->input('sale_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sale_returns = $sale_returns->whereBetween('sale_date', [$startDate, $endDate]);
            }
        }

        if ($request->has('return_date')) {
            $dateRange = explode(' - ', $request->input('return_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sale_returns = $sale_returns->whereBetween('return_date', [$startDate, $endDate]);
            }
        }

        return $sale_returns;
    }


    public static function boot()
    {
        parent::boot();

        static::saved(function ($sales) {
            $sales->sale->update_calculated_data();
        });

        static::deleting(function ($returns) {
            foreach ($returns->items as $item) {
                $item->delete();
            }
        });
    }
}
