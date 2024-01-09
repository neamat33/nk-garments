<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ProductionReceive;
use App\Models\ProductionReceiveDetail;
use Redirect,Response;

class ProductionReceiveController extends Controller
{

    function __construct()
    {
         $this->middleware('can:list-knitting', ['only' => ['index']]);
         $this->middleware('can:create-knitting', ['only' => ['create']]);
         $this->middleware('can:edit-knitting', ['only' => ['edit','update']]);
         $this->middleware('can:delete-knitting', ['only' => ['destroy']]);
         $this->middleware('can:knitting-stock', ['only' => ['stock_report']]);

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data['productions']= ProductionReceive::with('items')->paginate(10);
        
        return view('admin.production.production_receive.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['item'] = items::orderBy('id','desc')->where('product_type',0)->get();
        $data['departments'] = Department::orderBy('id','desc')->get();
        $data['employee'] = Employee::where('department_id', 4)->get();
        $data['department_id'] = session('department');
        return view('admin.production.production_receive.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_to' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
        ]);

        try {
            DB::beginTransaction();

            $production = ProductionReceive::create([
                'department_id'   => session('department'),
                'department_to'   => $request->department_to,
                'employee_id'     => $request->employee_id,
                'date'            => $request->date,
                'note'            => $request->note,
                'status'          => '1',
            ]);
            
            foreach ($request->new_item as $key=>$item_id) {
                $data['production_receive_id'] = $production->id;
                $data['item_id'] = $item_id;
                $data['dozen'] = $request->dozen[$key];
                $data['qty'] = $request->qty[$key];
                $production->items()->create($data); 
            }

            DB::commit();
            return back()->with('success', 'Production Receive successful!');
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
        $data['production'] = ProductionReceive::find($id);

        return view('admin.production.production_receive.show',$data);
    }
    public function print($id)
    {
        $data['production'] = ProductionReceive::find($id);

        return view('admin.production.production_receive.print',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['single'] =  ProductionReceive::find($id);
        $data['item'] = items::orderBy('id','desc')->where('product_type',0)->get();
        
        return view('admin.production.production_receive.edit',$data);
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
            ProductionReceive::where('id',$id)
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
        $production = ProductionReceive::find($id);
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

        return view('admin.production.production_receive.report',compact('knittings','send_items','start_date','end_date'));
    }

    
}
