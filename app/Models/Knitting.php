<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knitting extends Model
{
    use HasFactory;
    protected $table = "knitting";
    public function items()
    {
        return $this->hasMany(KnittingDetail::class,'knitting_id');
    }
    protected $guarded = [];
}
