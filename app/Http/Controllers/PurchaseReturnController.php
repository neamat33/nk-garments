<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\purchase;
use App\Models\PurchaseReturn;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;
class PurchaseReturnController extends Controller
{
    function __construct()
    {
        $this->middleware('can:list-party_purchase_return', ['only' => ['party_index']]);
        $this->middleware('can:list-petty_purchase_return', ['only' => ['petty_index']]);
        $this->middleware('can:create-purchase_return', ['only' => ['store']]);
        $this->middleware('can:delete-purchase_return', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function party_index(Request $request)
    {
        $parties = Party::orderBy('id','desc')->get();
        $purchase_returns= new PurchaseReturn();
        $purchase_returns = $purchase_returns->filter($request, $purchase_returns);

        $purchase_returns = $purchase_returns->where('purchase_type','Party Purchase')->orderBy('id','desc')->paginate(20);

       return view('admin.purchase.party.return.index',compact('purchase_returns','parties'));
    }

    public function petty_index(Request $request)
    {
        $parties = Party::orderBy('id','desc')->get();
        $purchase_returns= new PurchaseReturn();
        $purchase_returns = $purchase_returns->filter($request, $purchase_returns);
        $purchase_returns = $purchase_returns->where('purchase_type','Petty Purchase')->orderBy('id','desc')->paginate(20);

       return view('admin.purchase.petty.return.index',compact('purchase_returns','parties'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_id' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();
            
            $purch=purchase::findOrFail($request->purchase_id);
            $purchase_return = PurchaseReturn::create([
                'department_id'       => session('department'),
                'purchase_id'         => $request->purchase_id,
                'party_id'            => $purch->party_id,
                'purchase_date'       => $purch->purchase_date,
                'return_date'         =>  date('Y-m-d'),
                'purchase_form'       => $purch->purchase_form,
                'order_by_department' => $purch->order_by_department,
                'address'             => $purch->address,
                'phone'               => $purch->phone,
                'purchase_type'       => $purch->purchase_type,
                'note'                => $request->note,
            ]);

            foreach ($request->new_item as $key=>$item_id) {
                $item = items::find($item_id);
                if ($request->item_variation_id[$key]) {

                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);
                    
                    $data['department_id'] = session('department');
                    $data['purchase_return_id'] = $purchase_return->id;
                    $data['purchase_item_id'] = $request->purchase_item_id[$key];
                    $data['item_id']     = $item_id;
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['item_variation_id']= $request->item_variation_id[$key];
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $purchase_return->items()->create($data);

                }else{
                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    if ($request->main_unit_qty > 0 && $request->sub_unit_qty[$key] > 0) {
                        $main_qty = $request->main_unit_qty[$key];
                        $sub_qty = $request->sub_unit_qty[$key];
                    }elseif ($request->main_unit_qty > 0 && empty($request->sub_unit_qty[$key])) {
                        $main_qty = $request->main_unit_qty[$key];
                    }elseif (empty($request->main_unit_qty) && $request->sub_unit_qty[$key] > 0) {
                        $sub_qty = $request->sub_unit_qty[$key];
                    }
                    
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $data['department_id'] = session('department');
                    $data['purchase_return_id'] = $purchase_return->id;
                    $data['purchase_item_id'] = $request->purchase_item_id[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $purchase_return->items()->create($data);
                }
            }

            $purchase_return->update_calculated_data();
            
            DB::commit();
            if($purch->purchase_type == "Party Purchase"){
                return Redirect::route('party-purchase-return.index')->with('success', 'Purchase return successful!');
            }else{
                return Redirect::route('petty-purchase-return.index')->with('success', 'Purchase return successful!');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
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
    public function destroy(PurchaseReturn $purchase_return)
    {
        if ($purchase_return->delete()) {
            $purchase_return->update_calculated_data();
            session()->flash('success', 'Purchase Return Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }
}
