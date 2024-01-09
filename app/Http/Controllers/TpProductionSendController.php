<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;
use App\Models\TpProductionSend;
use App\Models\TpProductionSendDetail;
use App\Models\PurchaseItem;
use App\Models\Payment;
use Redirect,Response;

class TpProductionSendController extends Controller
{

    function __construct()
    {
         $this->middleware('can:list-tp_production_send', ['only' => ['index']]);
         $this->middleware('can:create-tp_production_send', ['only' => ['create']]);
         $this->middleware('can:edit-tp_production_send', ['only' => ['edit','update']]);
         $this->middleware('can:delete-tp_production_send', ['only' => ['destroy']]);
         $this->middleware('can:knitting-stock', ['only' => ['stock_report']]);

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data['productions']= TpProductionSend::orderBy('id','DESC')->paginate(10);
        
        return view('admin.production.tp_production_send.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['item'] = items::orderBy('id','desc')->get();
        $data['departments'] = Department::orderBy('id','desc')->get();
        $data['parties'] = Party::where('party_type', 'Third Party Production')->get();
        $data['department_id'] = session('department');
        return view('admin.production.tp_production_send.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required',
            'transport_detail' => 'required',
            'party_id' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
        ]);

        try {
            DB::beginTransaction();

            $production = TpProductionSend::create([
                'department_id'   => $request->department_id,
                'party_id'        => $request->party_id,
                'company_address' => $request->company_address,
                'transport_detail' => $request->transport_detail,
                'date'            => $request->date,
                'note'            => $request->note,
                'status'          => '1',
            ]);
            
            foreach ($request->send_item as $key=>$send_item_id) {
                $data['tp_production_send_id'] = $production->id;
                $data['item_id']     = $send_item_id;
                $data['dozen']     = $request->send_dozen[$key];
                $data['qty']     = $request->send_qty[$key];
                $data['weight']     = $request->send_weight[$key];
                $production->send_items()->create($data); 
            }

            foreach ($request->new_item as $key=>$item_id) {
                $data['tp_production_send_id'] = $production->id;
                $data['item_id'] = $item_id;
                $data['item_variation_id'] = $request->item_variation_id[$key];
                $data['dozen'] = $request->dozen[$key];
                $data['qty'] = $request->qty[$key];
                $data['weight'] = $request->weight[$key];
                $production->items()->create($data); 
            }

            DB::commit();
            return back()->with('success', 'Production Send successful!');
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['production'] = TpProductionSend::find($id);

        return view('admin.production.tp_production_send.print',$data);
    }
    public function print($id)
    {
        $data['production'] = ProductionSend::find($id);

        return view('admin.production.production_send.print',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['single'] =  ProductionSendDetail::find($id);
        $data['item'] = items::orderBy('id','desc')->where('product_type',0)->get();
        
        return view('admin.production.production_send.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'item_id' => 'required',
        'qty' => 'required',
        'weight' => 'required|',
        ]);
        try {
            ProductionSendDetail::where('id',$id)
            ->update([
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'weight' => $request->weight,
                
            ]);
            return redirect()->route('knitting.index')->with('success', 'Data updated!');
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Oops, operation failed!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $production = ProductionSend::find($id);
        if ($production->delete()) {
            $production->items()->delete();
            session()->flash('success', 'Purchase Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function stock_report(Request $request){

        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');

        if ($request->start_date) {
            $start_date = $request->start_date;
        }
        if ($request->end_date) {
            $end_date = $request->end_date;
        }

        $knittings = KnittingDetail::selectRaw('knitting_detail.item_id, items.name as item_name, SUM(knitting_detail.qty) as total_qty, SUM(knitting_detail.weight) as total_weight')
            ->join('items', 'knitting_detail.item_id', '=', 'items.id')
            ->groupBy('knitting_detail.item_id', 'items.name')
            ->whereBetween('knitting_detail.created_at', [$start_date, $end_date])
            ->paginate(10);

        $send_items = DB::table('bulk_send_detail')->selectRaw('bulk_send_detail.item_id, items.name as item_name, SUM(bulk_send_detail.qty) as total_qty, SUM(bulk_send_detail.cone) as total_cone')
            ->join('items', 'bulk_send_detail.item_id', '=', 'items.id')
            ->groupBy('bulk_send_detail.item_id', 'items.name')
            ->whereBetween('bulk_send_detail.created_at', [$start_date, $end_date])
            ->paginate(10);

        return view('admin.production.production_send.report',compact('knittings','send_items','start_date','end_date'));
    }

    
}
