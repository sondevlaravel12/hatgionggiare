<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function login(Request $request){
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->route('admin.dashboard')->with('success', 'suceessfully login');
        }else{
            return back()->with('error','Invalid email or password');
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login-form')->with('success', 'suceessfully logout');
    }
    public function register(){

        return view('admin.admin_register');
    }
    public function store(Request $request){
        //dd($request->all());
        Admin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now()
        ]);
        return redirect()->route('login-form')->with('success','successfully sign up');
    }
}
