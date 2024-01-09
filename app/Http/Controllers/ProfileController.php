<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\InputHelper;
use App\Models\User;
class ProfileController extends Controller
{
    private $avatar;
    private $path;

    public function __construct()
    {
        $this->path = 'asset/uploads/profile/';
        $this->avatar = 'asset/images/profile/1.jpg';

        $this->middleware('can:profile',  ['only' => ['index', 'update']]);
        $this->middleware('can:change_password',  ['only' => ['change_password', 'update_password']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return view('admin.profile.profile',compact('user'));
    }

    public function update(Request $request){
        $user = User::find(Auth::id());

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:500'
        ]);

          if ($request->hasFile('image')) {
            if ($user->image != $this->path) {
                InputHelper::delete($user);
            }
            $image = InputHelper::upload($request->image, $this->path);
            $user->image = $image;
        }

          // data upate

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        session()->flash('success', 'Profile Update Success...');

        return back();
    }

    public function change_password(){
        $user = User::find(Auth::id());
        return view('admin.profile.password',compact('user'));
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|same:password|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        if (Auth::Check()) {
            $current_password = Auth::User()->password;
            if (Hash::check($request->current_password, $current_password)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
            } else {
                session()->flash('error', 'Sorry, Your current password don\'t match.');
                return back();
            }
        }
        session()->flash('success', 'Password Update Success. Thanks.');
        return back();
    }
}
