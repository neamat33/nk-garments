<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Party;
use App\Models\PartySaleCommission;
use App\Models\PartySaleCommissionItem;
use Illuminate\Support\Facades\Redirect;
class PartySaleCommissionController extends Controller
{
    function __construct()
    {
         $this->middleware('can:list-party_sale_commission', ['only' => ['index']]);
         $this->middleware('can:create-party_sale_commission', ['only' => ['create']]);
         $this->middleware('can:delete-party_sale_commission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales_commissions= new PartySaleCommission();
        $sales_commissions = $sales_commissions->filter($request, $sales_commissions);
        $sales_commissions =   $sales_commissions->orderBy('id','desc')->paginate(20);
        $parties = Party::orderBy('id','desc')->get();
        return view('admin.sale.party.commission.index',compact('sales_commissions','parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = Party::orderBy('id','desc')->get();
        return view('admin.sale.party.commission.create',compact('parties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_id' => 'required|integer',
            'commission_date' => 'required|date|date_format:Y-m-d',
            'commission_per_qty' => 'required|numeric',
        ]);

        $party = Party::find($request->party_id);

        if (!$party) {
            return response()->json(['error' => 'Party not found!'], 404);
        }

        $partySales = $party->party_sale()->where('total_commission', '0')->get();

        if ($partySales->count() === 0) {
            return back()->with('warning', 'No commission invoice!');
        }

        try {
            DB::beginTransaction();

            $commission = PartySaleCommission::create([
                'department_id' => session('department'),
                'party_id' => $request->party_id,
                'commission_date' => $request->commission_date,
                'commission_per_qty' => $request->commission_per_qty,
                'note' => $request->note,
            ]);

            foreach ($partySales as $partySale) {
                $totalCommission = $partySale->total_qty * $request->commission_per_qty;
                
                PartySaleCommissionItem::create([
                    'department_id' => session('department'),
                    'party_sale_commission_id' => $commission->id,
                    'party_sale_id' => $partySale->id,
                    'total_qty' => $partySale->total_qty,
                    'commission_per_qty' => $request->commission_per_qty,
                    'total_commission' => $totalCommission,
                ]);
            }

            $commission->update_calculated_data();
            DB::commit();
            
            return redirect()->route('party-sale-commission.index')->with('success', 'Party Sale Commission successful!');
            
        } catch (\Exception $e) {
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
    public function destroy(PartySaleCommission $party_sale_commission)
    {
        if ($party_sale_commission->delete()) {
            session()->flash('success', 'Party Sale Commission Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function get_total_qty($partyId){
        $party = Party::find($partyId);
        if (!$party) {
            return response()->json(['error' => 'Party not found'], 404);
        }

        $totalInvoice = $party->commission_sale_invoice(); 
        $totalQty = $party->commission_sale_qty(); 
        return response()->json(['total_invoice' => $totalInvoice,'total_qty' => $totalQty]);
    }
}
