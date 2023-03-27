<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index', compact('coupons'));
    }
    public function create(){
        return view('admin.coupon.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2|max:255',
            'discount' => 'required|min:1|max:100',
            'expiry' => 'required',
        ]);
        $input = $request->except([]);
        $input['code'] = strtoupper( $input['code']);


        if($coupon = Coupon::create($input)){
            $notifycation = [
                'message' => 'Thêm mới coupon thành công',
                'alert-type' =>'success'
            ];
            return redirect()->route('admin.coupons.index')->with($notifycation);
        }
    }

    public function edit(Coupon $coupon){
        return view('admin.coupon.edit', compact('coupon'));
    }
    public function update(Coupon $coupon, Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2|max:255',
            'discount' => 'required|min:1|max:100',
            'expiry' => 'required',
        ]);
        $input = $request->except([]);
        $input['code'] = strtoupper( $input['code']);

        $coupon->update($input);

        $notifycation = [
            'message' => 'Cập nhật coupon thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.coupons.index')->with($notifycation);
    }
    public function destroy(Coupon $coupon){
        $coupon->delete();
        $notification = [
            'message' => 'xóa coupon thành công',
            'alert-type' =>'success'
        ];
        return back()->with($notification );
    }
}
