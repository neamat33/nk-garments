<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class PurchaseItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(purchase::class, 'purchase_id');
    }

    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }

    public function receive_challan_items()
    {
        return $this->hasMany(ReceiveChallanItem::class,'purchase_item_id');
    }

    public function return_purchase_items()
    {
        return $this->hasMany(PurchaseReturnItem::class,'purchase_item_id');
    }

    public function update_delivery_qty(){
        $due_main=$this->main_unit_qty - $this->receive_challan_items->sum('main_unit_qty') - $this->return_purchase_items->sum('main_unit_qty');
        $due_sub=$this->sub_unit_qty - $this->receive_challan_items->sum('sub_unit_qty') - $this->return_purchase_items->sum('sub_unit_qty');
        $delivery_qty=$this->receive_challan_items->sum('qty');
        $return_qty=$this->return_purchase_items->sum('qty');
        $due_qty=$this->qty - $delivery_qty - $return_qty;
        
        $this->update([
            'due_main_unit_qty' => $due_main,
            'due_sub_unit_qty'  => $due_sub,
            'delivery_qty'      => $delivery_qty,
            'due_qty'           => $due_qty,
        ]);
    }

    public function update_calculated_data(){
        $this->update_delivery_qty();
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }
}
