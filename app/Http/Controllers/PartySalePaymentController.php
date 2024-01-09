<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\BankAccount;
use App\Models\Party;
use App\Models\PartySalePayment;
use Illuminate\Support\Facades\Redirect;
class PartySalePaymentController extends Controller
{

    function __construct()
    {
        $this->middleware('can:party_sale_payment_list', ['only' => ['index']]);
        $this->middleware('can:party_sale_add_payment', ['only' => ['create']]);
        $this->middleware('can:party_sale_payment_delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sale_payments= new PartySalePayment();
        $sale_payments = $sale_payments->filter($request, $sale_payments);
        $sale_payments =   $sale_payments->orderBy('id','desc')->paginate(20);
        $bank_accounts=BankAccount::where('default',1)->get();
        $parties = Party::orderBy('id','desc')->get();

        return view('admin.sale.party.payment.index',compact('sale_payments','parties','bank_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = Party::orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();
        return view('admin.sale.party.payment.create',compact('parties','bank_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules for the incoming request
        $validated = $request->validate([
            'party_id' => 'required|integer',
            'bank_account_id' => 'required|integer',
            'payment_date' => 'required|date|date_format:Y-m-d',
            'pay_amount' => 'required|numeric',
        ]);
    
        // Retrieve party information
        $party = Party::find($request->party_id);
        $requestAmount = $request->pay_amount;
        $discount_amount = $request->discount_amount;
    
    
        // Check if the party exists
        if (!$party) {
            return response()->json(['error' => 'Party not found!'], 404);
        }
    
        // Retrieve party sales with due amount
        $partySales = $party->party_sale()->where('due', '>', 0)->get();
    
        // Check if there are any due invoices
        if ($partySales->count() === 0) {
            return back()->with('warning', 'No due invoice!');
        }
    
        try {
            DB::beginTransaction();
    
            // Create a party sale payment record
            $sale_payment = PartySalePayment::create([
                'party_id' => $request->party_id,
                'department_id' => session('department'),
                'bank_account_id' => $request->bank_account_id,
                'payment_date' => $request->payment_date,
                'discount_amount' => $request->discount_amount,
                'pay_amount' => $requestAmount,
                'note' => $request->note,
            ]);
    
            $tempAmount = $requestAmount;
    
            // Process payments for each party sale
            if ($partySales->count() > 0) {
                foreach ($partySales as $partySale) {
                    $due_amount = $partySale->due;
    
                    if ($tempAmount >= 0 && $due_amount <= $tempAmount) {
                        // Calculate percentage and discount based on due amount
                        $percentage = $due_amount / $requestAmount;
                        $paying_discount = $discount_amount * $percentage;
                        $paid_amount=$due_amount - $paying_discount;
                        // Create payment record for the party sale
                        $partySale->payments()->create([
                            'department_id' => session('department'),
                            'party_sale_payment_id' => $sale_payment->id,
                            'payment_date' => date('Y-m-d'),
                            'bank_account_id' => $request->bank_account_id,
                            'source_of_payment' => "Party Sale",
                            'payment_type' => 'receive',
                            'discount' => $paying_discount,
                            'amount' => $paid_amount,
                        ]);
    
                        // Update calculated data for the party sale
                        $partySale->update_calculated_data();
                    }
                }
            }

            $sale_payment->update_calculated_data();
    
            DB::commit();
    
            // Redirect with success message
            return redirect()->route('party-sale-payment.index')->with('success', 'Party Sale Payment successful!');
        } catch (\Exception $e) {
            // Rollback in case of an exception
            DB::rollback();
            Log::error($e);
            return back()->with('warning', 'Oops, operation failed!');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartySalePayment $party_sale_payment)
    {
        if ($party_sale_payment->delete()) {
            session()->flash('success', 'Party Sale Payments Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function get_total_due_invoice($partyId){
        $party = Party::find($partyId);
        if (!$party) {
            return response()->json(['error' => 'Party not found'], 404);
        }

        $totalDueInvoice = $party->sale_due_invoice(); 
        $totalDue = $party->sale_due(); 
        return response()->json(['total_due_invoice' => $totalDueInvoice,'total_due' => $totalDue]);
    }
}
