<?php

namespace App\Http\Controllers;

use App\Models\PartySale;
use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\PartySaleReturn;
use App\Models\items;
use App\Models\ItemVariation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class PartySaleReturnController extends Controller
{
    function __construct()
    {
        $this->middleware('can:list-party_sale_return', ['only' => ['index']]);
        $this->middleware('can:create-party_sale_return', ['only' => ['store']]);
        $this->middleware('can:delete-party_sale_return', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parties = Party::orderBy('id','desc')->get();
        $sale_returns= new PartySaleReturn();
        $sale_returns = $sale_returns->filter($request, $sale_returns);
        $sale_returns = $sale_returns->orderBy('id','desc')->paginate(20);
        
        return view('admin.sale.party.return.index',compact('sale_returns','parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_sale_id' => 'required|integer',
        ]);

        $sale=PartySale::findOrFail($request->party_sale_id);
        try {
            DB::beginTransaction();
            $sale_return = PartySaleReturn::create([
                'department_id' => session('department'),
                'party_sale_id' => $request->party_sale_id,
                'party_id'      => $sale->party_id,
                'sale_date'     => $sale->sale_date,
                'return_date'   =>  date('Y-m-d'),
                'note'          => $request->note,
                'return_commission' => $request->return_commission,
                'return_discount' => $request->return_discount,
            ]);

             foreach ($request->new_item as $key=>$item_id) {
                $item = items::find($item_id);
                $variationCount = ItemVariation::where('item_id', $item_id)->count();
                // dd($variationCount);

                if ($request->item_variation_id[$key]) {

                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);
                    
                    $data['department_id'] = session('department');
                    $data['party_sale_return_id'] = $sale_return->id;
                    $data['party_sale_item_id'] = $request->party_sale_item_id[$key];
                    $data['item_id']     = $item_id;
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['item_variation_id']= $request->item_variation_id[$key];
                    // $data['commission'] = $request->commission[$key];
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $sale_return->items()->create($data);

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
                    $data['party_sale_return_id'] = $sale_return->id;
                    $data['party_sale_item_id'] = $request->party_sale_item_id[$key];
                    $data['item_id']     = $item_id;
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    // $data['commission'] = $request->commission[$key];
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $sale_return->items()->create($data);
                }
                
            }

            $sale_return->update_calculated_data();
            DB::commit();
            // return redirect()->route('party-sale-return.index')->with('success', 'sale return successful!');
            return Redirect::route('party-sale-return.index')->with('success', 'sale return successful!');

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
    public function destroy(PartySaleReturn $sale_return)
    {
        if ($sale_return->delete()) {
            $sale_return->update_calculated_data();
            session()->flash('success', 'Challan Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }
}
