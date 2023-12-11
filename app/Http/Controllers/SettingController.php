<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\InputHelper;
class SettingController extends Controller
{

    private $default_image;
    private $path;

    public function __construct()
    {
        $this->path = 'asset/uploads/setting/';
        $this->default_image = 'asset/images/logo.png';
        $this->middleware('can:setting',  ['only' => ['setting', 'update_setting']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function setting()
    {
       $setting=Setting::first();
       return view('admin.setting.setting',compact('setting'));
    }

    public function update_setting(Request $request){
        $this->validate($request, [
            'company' => 'required|max:255',
            'phone' => 'required|max:191',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500'
        ]);

        $setting=Setting::first();
        // if ($request->hasFile('logo')) {
        //     $logo = InputHelper::upload($request->image, $this->path);
        //     if ($setting->logo != $this->path) {
        //         InputHelper::delete($setting);
        //     }
        // } else {
        //     $logo = $this->default_image;
        // }

        $setting->company = $request->company;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->invoice_logo_type = $request->invoice_logo_type;
        // $setting->logo = $logo;
        $setting->address = $request->address;

        $setting->save();
        session()->flash('success', 'Setting Updated.');
        return back();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
