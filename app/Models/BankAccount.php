<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class BankAccount extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // CUSTOM FUNBCTIONS
    public function balance()
    {
        // Opening Balance+SUM OF ALL PAYMENT RECEIVED(SELL)
        $opening_balance = $this->opening_balance;
        $all_received = Payment::where('bank_account_id', $this->id)->where('payment_type', 'receive')->sum('amount');
        
        // dd($all_received);
        $total_added = $opening_balance + $all_received;

        // ALL MONEY SPENT+LC PAYMENT
        $all_spent = Payment::where('bank_account_id', $this->id)->where('payment_type', 'pay')->sum('amount');
        // ----------------------
        $total_spent = $all_spent;
        // dd($total_spent);
        return $total_added - $total_spent;
    }
    public function previousBalance($account_id)
    {
        // Opening Balance+SUM OF ALL PAYMENT RECEIVED(SELL)
        $opening_balance = $this->opening_balance;

        $today = now()->format('Y-m-d'); // Current date and time
        $all_received = Payment::where('bank_account_id', $account_id)
            ->where('payment_type', 'receive')
            ->where('payment_date', '<', $today)
            ->sum('amount');
        
        // dd($all_received);
        $total_added = $opening_balance + $all_received;

        // ALL MONEY SPENT+LC PAYMENT
        $all_spent = DB::table('payments')->where('bank_account_id', $account_id)->where('payment_type', 'pay')->where('payment_date','<',$today)->sum('amount');
        // ----------------------
        $total_spent = $all_spent;
        // dd($total_spent);
        return $total_added - $total_spent;
    }

   public static function sumAllBalances()
    {
        return self::all()->sum->balance();
    }

}