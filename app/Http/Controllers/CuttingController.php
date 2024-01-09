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
use App\Models\Cutting;
use App\Models\CuttingDetail;
use App\Models\CuttingRawDetail;
use Redirect,Response;

class CuttingController extends Controller
{

    function __construct()
    {
         $this->middleware('can:list-cutting', ['only' => ['index']]);
         $this->middleware('can:create-cutting', ['only' => ['create']]);
         $this->middleware('can:edit-cutting', ['only' => ['edit','update']]);
         $this->middleware('can:delete-cutting', ['only' => ['destroy']]);

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data['cuttings']= Cutting::paginate(10);
        
        return view('admin.production.cutting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['raw_item'] = items::orderBy('id','desc')->where('product_type',1)->get();
        $data['item'] = items::orderBy('id','desc')->where('product_type',0)->get();
        $data['departments'] = Department::orderBy('id','desc')->get();
        return view('admin.production.cutting.create',$data);
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

            $cutting = Cutting::create([
                'department_id' => session('department'),
                'department_to'   => $request->department_to,
                'date'            => $request->date,
                'note'            => $request->note,
                'status'            => '1',
            ]);
            
            foreach ($request->raw_item as $key=>$raw_item_id) {
                $data['cutting_id'] = $cutting->id;
                $data['item_id']     = $raw_item_id;
                $data['item_variation_id'] = $request->item_variation_id[$key];
                $data['qty']     = $request->raw_qty[$key];
                $data['weight']     = $request->raw_weight[$key];
                $cutting->raw_items()->create($data); 
            }

            foreach ($request->new_item as $key=>$item_id) {
                $data['cutting_id'] = $cutting->id;
                $data['item_id']     = $item_id;
                $data['item_variation_id'] = $request->item_variation_id[$key];
                $data['dozen'] = $request->dozen[$key];
                $data['qty']     = $request->qty[$key];
                $data['weight']     = $request->weight[$key];
                $cutting->items()->create($data); 
            }

            DB::commit();
            return back()->with('success', 'Cutting Receive successful!');
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
        $data['cutting'] = Cutting::find($id);

        return view('admin.production.cutting.show',$data);
    }
    public function print($id)
    {
        $data['cutting'] = Cutting::find($id);

        return view('admin.production.cutting.print',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['single'] =  Cutting::find($id);
        $data['item'] = items::orderBy('id','desc')->where('product_type',0)->get();
        
        return view('admin.production.cutting.edit',$data);
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
            CuttingDetail::where('id',$id)
            ->update([
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'weight' => $request->weight,
                
            ]);
            return redirect()->route('cutting.index')->with('success', 'Data updated!');
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

        $cutting = Cutting::find($id);
            $cutting->delete();
            $cutting->items()->delete();
            $cutting->raw_items()->delete();

        if ($cutting) {
            session()->flash('success', 'Cutting Items Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function report(Request $request){

        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');

        if ($request->start_date) {
            $start_date = $request->start_date;
        }
        if ($request->end_date) {
            $end_date = $request->end_date;
        }


        $item = CuttingDetail::selectRaw('cutting_details.item_id, items.name as item_name, SUM(cutting_details.qty) as total_qty, SUM(cutting_details.weight) as total_weight')
            ->join('items', 'cutting_details.item_id', '=', 'items.id')
            ->join('cuttings', 'cuttings.id', '=', 'cutting_details.cutting_id')
            ->groupBy('cutting_details.item_id', 'items.name')
            ->where('cuttings.department_id', session('department'));
            
            if($request->cutting_id){
                $item->where('cutting_details.cutting_id', $request->cutting_id);
            }else{
                $item->whereBetween('cutting_details.created_at', [$start_date, $end_date]);
            }
            $items = $item->paginate(10);

        $raw_item = CuttingRawDetail::selectRaw('cutting_raw_details.item_id, items.name as item_name, SUM(cutting_raw_details.qty) as total_qty, SUM(cutting_raw_details.weight) as total_weight')
            ->join('items', 'cutting_raw_details.item_id', '=', 'items.id')
            ->join('cuttings', 'cuttings.id', '=', 'cutting_raw_details.cutting_id')
            ->groupBy('cutting_raw_details.item_id', 'items.name')
            ->where('cuttings.department_id', session('department'));

            if($request->cutting_id){
                $raw_item->where('cutting_raw_details.cutting_id', $request->cutting_id);
            }else{
                $raw_item->whereBetween('cutting_raw_details.created_at', [$start_date, $end_date]);
            }
            $raw_items = $raw_item->paginate(10);
 

        return view('admin.production.cutting.report',compact('items','raw_items','start_date','end_date'));
    }

    
}
