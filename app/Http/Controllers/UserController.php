<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments=Department::where('status',1)->orderBy('id','desc')->get();
        $roles = Role::where('name','!=','test_admin')->get();

        $currentUser = Auth::id();
        $users = User::whereHas('roles',function($roles){
            $roles->where('name','!=','test_admin');
        })->orderBy('created_at', 'desc')->where('id', '!=', $currentUser)->paginate(10);
        return view('admin.user.index',compact('users','departments','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments=Department::where('status',1)->orderBy('id','desc')->get();
        $roles = Role::where('name','!=','test_admin')->get();
        return view('admin.user.create',compact('departments','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191|email|unique:users',
            'role' => 'required',
            'password' => 'required|max:191|min:6|same:password',
            'password_confirmation' => 'required|min:6|max:191|same:password',
        ]);

        $data = $request->all();
        unset($data['role']);
        unset($data['avatar']);
        unset($data['password_confirmation']);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->syncRoles([$request->role]);

        session()->flash('success', 'User Create.');
        return back();
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
    

    public function update(Request $request,$id){
     $user = User::find($id);
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191|email|unique:users,email,' . $user->id,
            'role' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id'=> $request->department_id,
        ]);

        $user->syncRoles([$request->role]);
        session()->flash('success', 'User Create.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User Delete.');
        return back();
    }
}
