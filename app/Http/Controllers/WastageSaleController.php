<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankAccount;
use App\Models\Employee;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Branch;
use App\Models\Party;
use Redirect,Response;
class WastageSaleController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = new Sale();
        $sales = $sales->filter($request, $sales);
        $sales = $sales->where('sale_type','Wastage')->orderBy('id','desc')->paginate(20);
        $parties = Party::orderBy('id','desc')->get();
        $employees = Employee::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();
        return view('admin.sale.wastage.index',compact('sales','parties','employees','showrooms','bank_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = items::orderBy('id','desc')->get();
        $employees =  Employee::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();

        return view('admin.sale.wastage.create',compact('item','employees','showrooms','bank_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'sale_date' => 'required|date|date_format:Y-m-d',
            'sold_by' => 'required',
            'receivable' =>'required',
        ]);

        try {
            DB::beginTransaction();
            
            $sale = Sale::create([
                'department_id'    => session('department'),
                'sale_type'        => 'Wastage',
                'customer_name'    => $request->customer_name,
                'customer_address' => $request->customer_address,
                'phone'            => $request->phone,
                'sale_date'        => $request->sale_date,
                'showroom'         => $request->showroom,
                'delivery_date'    => $request->delivery_date,
                'delivery_to'      => $request->delivery_to,
                'sold_by'          => $request->sold_by,
                'note'             => $request->note,
                'total_discount'   => $request->total_discount,
                'receivable'       => $request->receivable,
                'final_receivable' => $request->receivable,
            ]);

            
            foreach ($request->new_item as $key=>$item_id) {
                $item = items::find($item_id);
                $variations = ItemVariation::where('item_id', $item_id)->get();
                $variationCount = $variations->count();

                if ($request->item_variation_id[$key]) {
                    $data = [];
                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $selectedVariation = ItemVariation::find($request->item_variation_id[$key]);

                    if ($selectedVariation->stock() < $qty) {
                        DB::rollback();
                        return back()->with('error', 'Insufficient stock for the selected variation.');
                    }

                    $data['department_id'] = session('department');
                    $data['sale_id'] = $sale->id;
                    $data['item_id'] = $item_id;
                    $data['details'] = $request->item_details[$key];
                    $data['item_variation_id'] = $request->item_variation_id[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty'] = $qty;
                    $data['commission'] = $request->commission[$key];
                    $data['rate'] = $request->rate[$key];
                    $data['sub_total'] = $request->sub_total[$key];
                    $sale->items()->create($data);

                }elseif ($variationCount > 0 && $request->item_variation_id[$key] == '') {
                    $data = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;
                    $commission = 0;
                    $rate = 0;
                    $subTotal = 0;

                     if ($request->main_unit_qty > 0 && $request->sub_unit_qty[$key] > 0) {
                        $sub_qty = ($request->related_by[$key] / $variationCount * $request->main_unit_qty[$key]) + ($request->sub_unit_qty[$key] / $variationCount);
                    } elseif ($request->main_unit_qty > 0 && empty($request->sub_unit_qty[$key])) {
                        $sub_qty = ($request->related_by[$key] / $variationCount * $request->main_unit_qty[$key]);
                    } elseif (empty($request->main_unit_qty) && $request->sub_unit_qty[$key] > 0) {
                        $sub_qty = ($request->related_by[$key] / $variationCount * $request->sub_unit_qty[$key]);
                    }
                    
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);
                    $commission = $request->commission[$key];
                    $rate = $request->rate[$key] / $request->related_by[$key] - $commission;
                    $subTotal = $rate * $qty;

                    // Check if variations exist before processing
                    $variations = ItemVariation::where('item_id', $item_id)->get();
                    if ($variations->count() > 0) {
                        // Check if stock is sufficient for each variation
                        $insufficientStock = false;

                        foreach ($variations as $variation) {
                            // Check if the stock of the variation is less than $qty
                            if ($variation->stock() < $qty) {
                                $insufficientStock = true;
                                break; // Stop the loop if any variation has insufficient stock
                            }
                        }

                    if (!$insufficientStock) {
                        // Proceed to create sale items if stock is sufficient for all variations
                        foreach ($variations as $variation) {
                            $data['department_id'] = session('department');
                            $data['sale_id'] = $sale->id;
                            $data['item_id'] = $item_id;
                            $data['item_variation_id'] = $variation->id;
                            $data['details'] = $request->item_details[$key];
                            $data['main_unit_qty'] = $main_qty;
                            $data['sub_unit_qty'] = $sub_qty;
                            $data['qty'] = $qty;
                            $data['commission'] = $commission;
                            $data['rate'] = $rate;
                            $data['sub_total'] = $subTotal;
                            $sale->items()->create($data);
                        }
                    } else {
                         return back()->with('error', 'Insufficient stock for the selected variations.');
                    }
                }
            }
            else{
                $data   = [];
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

                $selectedItem = items::find($request->new_item[$key]);
                
                if ($selectedItem->stock() < $qty) {
                    DB::rollback();
                    return back()->with('error', 'Insufficient stock for the selected variation.');
                }

                    $data['department_id'] = session('department');
                    $data['sale_id'] = $sale->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['commission'] = $request->commission[$key];
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $sale->items()->create($data);
                }
                
            }

            if ($request->pay_amount != null) {
                
                $sale->payments()->create([
                    'department_id'     => session('department'),
                    'payment_date'      =>  $request->sale_date,
                    'bank_account_id'   => $request->bank_account_id,
                    'source_of_payment' => "Wastage Sale",
                    'payment_type'      => 'receive',
                    'amount'        => $request->pay_amount,
                ]);
            }

            $sale->update_calculated_data();

            DB::commit();
            return back()->with('success', 'data saved!');

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
    public function edit(Sale $wastage_sale)
    {
        $employees = Employee::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();

        return view('admin.sale.wastage.edit',compact('wastage_sale','employees','showrooms','bank_accounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $wastage_sale)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'sale_date' => 'required|date|date_format:Y-m-d',
            'sold_by' => 'required',
            'receivable' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Update Sale details
            $wastage_sale->update([
                'department_id' => session('department'),
                'sale_type' => 'Wastage',
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'phone' => $request->phone,
                'sale_date' => $request->sale_date,
                'showroom' => $request->showroom,
                'delivery_date' => $request->delivery_date,
                'delivery_to' => $request->delivery_to,
                'sold_by' => $request->sold_by,
                'note' => $request->note,
                'total_discount' => $request->total_discount,
                'receivable' => $request->receivable,
                'final_receivable' => $request->receivable,
            ]);

            // Clear existing items
            $wastage_sale->items()->delete();

            // Insert or update items
            foreach ($request->new_item as $key => $item_id) {
                $item = items::find($item_id);
                $variations = ItemVariation::where('item_id', $item_id)->get();
                $variationCount = $variations->count();

                if ($request->item_variation_id[$key]) {
                    $data = $this->prepareItemData($request, $key, $item_id, $wastage_sale, $variationCount);
                    $wastage_sale->items()->create($data);

                } elseif ($variationCount > 0 && $request->item_variation_id[$key] == '') {
                    $data = $this->prepareItemData($request, $key, $item_id, $wastage_sale, $variationCount);
                    $wastage_sale->items()->create($data);

                } else {
                    $data = $this->prepareItemData($request, $key, $item_id, $wastage_sale, $variationCount);
                    $wastage_sale->items()->create($data);
                }
            }

            $wastage_sale->update_calculated_data();

            DB::commit();
            return back()->with('success', 'Data updated!');
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Oops, operation failed!');
        }
    }

    // Additional method to prepare item data
    private function prepareItemData($request, $key, $item_id, $wastage_sale, $variationCount)
    {
        $item = items::find($item_id);

        $data = [];
        $main_qty = $request->main_unit_qty[$key];
        $sub_qty = $request->sub_unit_qty[$key];
        $qty = $item->to_sub_quantity($main_qty, $sub_qty);

        if ($variationCount > 0) {
            $selectedVariation = ItemVariation::find($request->item_variation_id[$key]);

            if ($selectedVariation->stock() < $qty) {
                DB::rollback();
                return back()->with('error', 'Insufficient stock for the selected variation.');
            }
        }

        $data['department_id'] = session('department');
        $data['sale_id'] = $wastage_sale->id;
        $data['item_id'] = $item_id;
        $data['details'] = $request->item_details[$key];
        $data['item_variation_id'] = $request->item_variation_id[$key];
        $data['main_unit_qty'] = $main_qty;
        $data['sub_unit_qty'] = $sub_qty;
        $data['qty'] = $qty;
        $data['commission'] = $request->commission[$key];
        $data['rate'] = $request->rate[$key];
        $data['sub_total'] = $request->sub_total[$key];

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */

  
    public function destroy(Sale $wastage_sale)
    {
        if ($wastage_sale->delete()) {
            $wastage_sale->payments()->delete();
            session()->flash('success', 'Sale Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function get_sale($id){
        $where = array('id' => $id);
		$sale = Sale::where($where)->first();
		return Response::json($sale);
    }

    public function by_invoice(Request $request)
    {
        $sale = Sale::findOrFail($request->invoice_id);
        $sale->payments()->create([
            'payment_date'      =>   date('Y-m-d'),
            'bank_account_id'   => $request->bank_account_id,
            'source_of_payment' => "Wastage Sale",
            'payment_type'      => 'receive',
            'amount'            => $request->pay_amount,
        ]);

        if($sale){
            $sale->update_calculated_data();
            session()->flash('success', 'Payment Completed...');
        }else{
            session()->flash('warning', 'Opps operation failed!');
        }
        
        return back();
    }

    public function report(){
        $sales = SaleItem::with('sale')
        ->whereHas('sale', function ($query) {
            $query->where('sale_type', 'Wastage');
        })->orderBy('id', 'desc')->paginate(20);

        return view('admin.sale.wastage.report',compact('sales'));
    }

    public function invoice($sale_id){
        $sales  = Sale::findOrFail($sale_id);
        return view('admin.sale.wastage.invoice',compact('sales'));
    }
}
