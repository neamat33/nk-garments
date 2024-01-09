<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    function __construct()
    {
        $this->middleware('can:create-brand', ['only' => ['create','store','edit','update']]);
        $this->middleware('can:delete-brand', ['only' => ['destroy']]);
    }
    
    public function index(){

    }

    public function create(){
        $result = brand::orderBy('id','desc')->paginate(10);
        return view('admin.brand.create',compact('result'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:brands',
        ]);

        brand::create([
            'name'=>$request->name,
            'status'=>$request->status
        ]);

        return back()->with('success','brand created successfully');
    }

    public function show($id)
    {
      dd('show');
    }
    public function update(Request $request,$id){
      brand::find($id)->update(['name'=>$request->name,'status'=>$request->status]);
      return redirect()->back()->with('success','brand updated successfully');
    }
}
