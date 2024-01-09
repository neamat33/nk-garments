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
use App\Models\TpProductionSendRawDetail;
use App\Models\TpProductionReceive;
use App\Models\TpProductionReceiveDetail;
use App\Models\PurchaseItem;
use App\Models\Payment;
use Redirect,Response;
use View;
class TpProductionReceiveController extends Controller
{

    function __construct()
    {
         $this->middleware('can:list-tp_production_receive', ['only' => ['index']]);
         $this->middleware('can:create-tp_production_receive', ['only' => ['create']]);
         $this->middleware('can:edit-tp_production_receive', ['only' => ['edit','update']]);
         $this->middleware('can:delete-tp_production_receive', ['only' => ['destroy']]);
        

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data['productions']= TpProductionReceive::paginate(10);
        
        return view('admin.production.tp_production_receive.index',$data);
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
        return view('admin.production.tp_production_receive.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'production_id' => 'required',
            'transport_detail' => 'required',
            'party_id' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
        ]);

        try {
            DB::beginTransaction();
            $production = TpProductionReceive::create([
                'department_id' => session('department'),
                'tp_production_send_id'   => $request->tp_production_send_id,
                'party_id'        => $request->party_id,
                'transport_detail' => $request->transport_detail,
                'date'            => $request->date,
                'note'            => $request->note,
                'status'          => '1',
            ]);

            
            foreach ($request->new_item as $key=>$item_id) {
                $data['tp_production_receive_id'] = $production->id;
                $data['item_id'] = $item_id;
                $data['item_variation_id'] = $request->item_variation_id[$key];
                $data['dozen'] = $request->dozen[$key];
                $data['qty'] = $request->qty[$key];
                $data['weight'] = $request->weight[$key];
                $production->items()->create($data); 
            }
            $production_id = $request->input('production_id');
            if ($request->has('all_receive')) {
                TpProductionSend::where('id', $production_id)->update(['status' => 3]);
            }else{
                if($production){
                    TpProductionSend::where('id', $production_id)->update(['status' => 2]);
                }
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
        $data['production'] = TpProductionReceive::find($id);

        return view('admin.production.tp_production_receive.print',$data);
    }
    public function print($id)
    {
        $data['production'] = TpProductionReceive::find($id);

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
            TpProductionReceive::where('id',$id)
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
        $production = TpProductionReceive::find($id);
        if ($production->delete()) {
            $production->items()->delete();
            session()->flash('success', 'Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function getSendInfo()
    {
        // production_id
        $prod_id = $_GET['prod_id'];
        
        $data['item'] = items::orderBy('id','desc')->get();
        $data['departments'] = Department::orderBy('id','desc')->get();
        $data['parties'] = Party::where('party_type', 'Third Party Production')->get();

        $prod = TpProductionSend::find($prod_id);

        if($prod){
            if($prod->status == 3){
                return response()->json([
                    'status' => $prod->status,
                ]);
            }
        }else{
            return response()->json([
                'status' => false,
            ]);
        }

        $data['production'] = TpProductionSend::where('id',$prod_id)->whereIn('status', [1, 2])->first();

        return response()->json([
            'view' => (string)View::make("admin.production.tp_production_receive.get_send_info", $data)
        ]);
    }

    public function stock_report(Request $request){

        $parties = Party::where('party_type', 'Third Party Production')->get();
        $production_id = $request->input('production_id');
        $party_id = $request->input('party_id');

        $send_items = '';
        $receive_items = '';
        if($production_id){
            $send_items = TpProductionSend::where('id',$production_id)->get();
            $receive_items = TpProductionReceive::where('tp_production_send_id',$production_id)->get();
        }elseif($request->has('party_id')){
            $send_items = TpProductionSend::where('party_id', $party_id)->get();
            $receive_items = TpProductionReceive::where('party_id', $party_id)->get();
        }
        
        
   
        return view('admin.production.tp_production_receive.report',compact('receive_items','send_items','parties'));
    }

    
}
