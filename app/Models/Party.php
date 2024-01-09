<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function party_sale()
    {
        return $this->hasMany(PartySale::class,'party_id');
    }

    public function purchase()
    {
        return $this->hasMany(purchase::class,'party_id');
    }

    public function commission_sale_qty(){
        return $this->party_sale()->where('total_commission', 0)->sum('total_qty');
    }

    public function commission_sale_invoice(){
        return $this->party_sale()->where('total_commission', 0)->count();
    }

    public function sale_due_invoice(){
        return $this->party_sale()->where('due','>',0)->count();

    }

    public function sale_due(){
        return $this->party_sale()->sum('due');
    }

    public function purchase_due(){
        return $this->purchase()->sum('due');
    }

    // Don't delete if any relation is existing
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($rel) {
            $relationMethods = ['party_sale', 'purchase'];

            foreach ($relationMethods as $relationMethod) {
                if ($rel->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }
}
