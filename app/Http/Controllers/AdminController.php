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
    public function profile(){
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }
    public function login(Request $request){
        // guard admin defined in auth.php, guard is relatived with database table, middleware is used to filter or inspect incoming requests.
        $attemp = Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password]);
        if($attemp){
            if(Auth::guard('admin')->user()->status==0) {
                Auth::guard('admin')->logout();
                return back()->with('error','Your account is inactive');
            }
            return redirect()->route('admin.dashboard')->with('success', 'suceessfully login');
        }else{
            /// reload login form
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
