<?php

namespace App\Http\Controllers;

use App\Models\BulkSendDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;
use App\Models\BulkSend;
use App\Models\PurchaseItem;
use App\Models\Payment;
use Redirect,Response;

class BulkSendController extends Controller
{

    function __construct()
    {
         $this->middleware('can:list-bulk_send', ['only' => ['index']]);
         $this->middleware('can:create-bulk_send', ['only' => ['create']]);
         $this->middleware('can:edit-bulk_send', ['only' => ['edit','update']]);
         $this->middleware('can:delete-bulk_send', ['only' => ['destroy']]);
         $this->middleware('can:party_purchase_invoice', ['only' => ['invoice']]);
         $this->middleware('can:party_purchase_report', ['only' => ['report']]);
         $this->middleware('can:party_purchase_add_payment', ['only' => ['by_invoice']]);
         $this->middleware('can:party_purchase_payment_list', ['only' => ['payment_list']]);
        $this->middleware('can:create-purchase_return', ['only' => ['return_purchase']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $data['send_items']=DB::table('bulk_send as s')
            ->select('s.id','s.date','s.status','dpf.name as department_from','dpt.name as department_to','i.name as item','sd.qty','sd.cone','sd.id as bulk_detail_id')
            ->join('bulk_send_detail as sd','s.id','=','sd.bulk_send_id')
            ->join('departments as dp','dp.id','=','s.department_id')
            ->join('departments as dpf','dpf.id','=','s.department_from')
            ->join('departments as dpt','dpt.id','=','s.department_to')
            ->join('items as i','i.id','=','sd.item_id')
            ->where('s.department_id',session('department'))
            ->paginate(10);
        
        return view('admin.production.bulk.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['item'] = items::orderBy('id','desc')->where('product_type',1)->get();
        $data['departments'] = Department::orderBy('id','desc')->get();
        $data['department_id'] = session('department');
        return view('admin.production.bulk.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_from' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
        ]);

        try {
            DB::beginTransaction();

            $bulksend = BulkSend::create([
                'department_id' => session('department'),
                'department_from' => $request->department_from,
                'department_to'   => $request->department_to,
                'date'            => $request->date,
                'status'            => '1',
            ]);
            
            foreach ($request->new_item as $key=>$item_id) {
                $data['bulk_send_id'] = $bulksend->id;
                $data['item_id']     = $item_id;
                $data['qty']     = $request->qty[$key];
                $data['cone']     = $request->cone[$key];
                $bulksend->items()->create($data);

                $item = items::find($item_id); // Fetch the item by its ID

                if ($item) {
                    $item->increment('total_production', $request->qty[$key]);
                    $item->decrement('cone', $request->cone[$key]);
                }
                 
            }



            DB::commit();
            return back()->with('success', 'Bulk Send successful!');
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
    public function edit($id)
    {
        $data['single'] =  BulkSendDetail::find($id);
        $data['item'] = items::orderBy('id','desc')->where('product_type',1)->get();
        
        return view('admin.production.bulk.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
        'item_id' => 'required',
        'qty' => 'required',
        'cone' => 'required|',
        ]);
        try {
            BulkSendDetail::where('id',$id)
            ->update([
                'item_id' => $request->item_id,
                'qty' => $request->qty,
                'cone' => $request->cone,
                
            ]);
            return redirect()->route('bulk_send.index')->with('success', 'Data updated!');
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Oops, operation failed!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(purchase $party_purchase)
    {
        if ($party_purchase->delete()) {
            session()->flash('success', 'Purchase Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function report(){
        $purchases = PurchaseItem::with('purchase')
        ->whereHas('purchase', function ($query) {
            $query->where('purchase_type', 'Party Purchase');
        })->orderBy('id', 'desc')->paginate(20);

        return view('admin.purchase.party.report',compact('purchases'));
    }

    public function challan_receive(purchase  $purchase){
        $item = items::orderBy('id','desc')->get();
        $parties =  Party::orderBy('id','desc')->get();
        $departments = Department::orderBy('id','desc')->get();
        $employees =  Employee::orderBy('id','desc')->get();

        return view('admin.challan.receive.create',compact('purchase','item','parties','departments','employees'));
    }

    public function get_purchase ($id){
        $where = array('id' => $id);
		$purchase = purchase::where($where)->first();
		return Response::json($purchase);
    }
    

    public function by_invoice(Request $request){
        $purchase = purchase::findOrFail($request->invoice_id);

        $purchase->payments()->create([
            'department_id'     => session('department'),
            'payment_date'      => date('Y-m-d'),
            'bank_account_id'   => $request->bank_account_id,
            'source_of_payment' => "Party Purchase",
            'payment_type'      => 'pay',
            'amount'            => $request->pay_amount,
        ]);

        if($purchase){
            $purchase->update_calculated_data();
            session()->flash('success', 'Payment Completed...');
        }else{
            session()->flash('warning', 'Opps operation failed!');
        }
        
        return back();
    }

    public function return_purchase(purchase $party_purchase){
        $item = items::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $employees =  Employee::orderBy('id','desc')->get();
        
        if($party_purchase->purchase_return()->count() > 0){
            session()->flash('warning', 'This purchase has already been returned.');
            return back();
        }

        return view('admin.purchase.party.return.create',compact('party_purchase','item','showrooms','employees'));
    }

    public function payment_list(purchase $party_purchase){
        $payments = Payment::where('source_of_payment','Party Purchase')->where('paymentable_id',$party_purchase->id)->orderBy('id','desc')->paginate(20);

        return view('admin.purchase.party.payment-list',compact('payments'));
    }

    public function invoice($purchase_id){
        $purchase  = purchase::findOrFail($purchase_id);
        return view('admin.purchase.party.invoice',compact('purchase'));
    }
    
}
