<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = auth()->user();
       if(auth()->user()->hasAnyRole('admin')||auth()->user()->hasAnyRole('test_admin')){
            // dd(session('test'));
            if(session('department')==null){
                session(['department'=>1]);
                session()->flash('success','Default Department Selected!');
            }
        }else{
            // set user branch
            // dd("HERE");
            if(session('department')==null){
                session(['department'=>$user->department_id]);
            }
        }
        // dd("HERE");
        return $next($request);
    }
}
