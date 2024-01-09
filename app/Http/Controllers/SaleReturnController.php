<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\SaleReturn;
use App\Models\items;
use App\Models\ItemVariation;
use Illuminate\Support\Facades\Redirect;
class SaleReturnController extends Controller
{

    function __construct()
    {
        $this->middleware('can:list-cash_sale_return', ['only' => ['index']]);
        $this->middleware('can:create-cash_sale_return', ['only' => ['store']]);
        $this->middleware('can:delete-cash_sale_return', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sale_returns= new SaleReturn();
        $sale_returns = $sale_returns->filter($request, $sale_returns);
        $sale_returns = $sale_returns->orderBy('id','desc')->paginate(20);
        
        return view('admin.sale.cash.return.index',compact('sale_returns'));
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
            'sale_id' => 'required|integer',
        ]);

        $sale=Sale::findOrFail($request->sale_id);
        try {
            DB::beginTransaction();
            $sale_return = SaleReturn::create([
                'department_id' => session('department'),
                'sale_id'       => $request->sale_id,
                'customer_name' => $sale->customer_name,
                'customer_address' => $sale->customer_address,
                'phone'         => $sale->phone,
                'sale_date'     => $sale->sale_date,
                'sale_type'     => $sale->sale_type,
                'return_date'   =>  date('Y-m-d'),
                'note'          => $request->note,
                'return_commission' => $request->return_commission,
                'return_discount' => $request->return_discount,
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
                    $data['sale_return_id'] = $sale_return->id;
                    $data['sale_item_id'] = $request->sale_item_id[$key];
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
                    $data['sale_return_id'] = $sale_return->id;
                    $data['sale_item_id'] = $request->sale_item_id[$key];
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
            // return redirect()->back()->with('success', 'Sale return successful!')->route('cash-sale-return.index');
            return Redirect::route('cash-sale-return.index')->with('success', 'sale return successful!');


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
    public function destroy(SaleReturn $sale_return)
    {
         if ($sale_return->delete()) {
            $sale_return->update_calculated_data();
            session()->flash('success', 'Sale Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }
}
