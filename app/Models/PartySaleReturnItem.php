<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartySaleReturnItem extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }

    public function party_sale_item()
    {
        return $this->belongsTo(PartySaleItem::class,'party_sale_item_id');
    }

    public static function boot()
    {
        parent::boot();
        // for created & updated
        static::saved(function($item){
            $item->party_sale_item->update_delivery_qty();
        });

        static::deleted(function ($delivery_item) {
            $delivery_item->party_sale_item->update_delivery_qty();
        });
    }

}
