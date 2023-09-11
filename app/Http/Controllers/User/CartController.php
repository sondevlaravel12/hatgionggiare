<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Webinfo;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        return view('cart.index');
    }
    public function checkout(){
        $shipping_fee = Webinfo::first()->shipping_fee;
        $total = filter_var(Cart::total(), FILTER_SANITIZE_NUMBER_INT) + $shipping_fee;
        $shipping_fee = number_format($shipping_fee,0,',','.');
        $total = number_format($total,0,',','.');
        if(Cart::content()->count()<1){
            return redirect()->back()->with('message','Quý khách vui lòng đặt hàng lại!');
        }
        $title = 'Tiến hành thanh toán đơn hàng';
        return view('cart.checkout')->with(['title'=>$title,'shipping_fee'=>$shipping_fee,'total'=>$total]);
    }
    public function indexAjaxShowCartItem(){
        $contents = Cart::content();
    	$quantity = Cart::count();
    	$subtotal = Cart::subtotal();

    	return response()->json(array(
    		'contents' => $contents,
    		'quantity' => $quantity,
    		'subtotal' => $subtotal,

    	));
    }
    public function removeCartItem($itemId){
        Cart::remove($itemId);
        if(Cart::count()==0){
            Session::forget('coupon');
        }
        return response()->json(['success'=>'xóa sản phẩm thành công']);
    }
    public function increaseQuantity($rowId){
        $cartItem = Cart::get($rowId);
        $updated = Cart::update($rowId, $cartItem->qty+1 );
        return response()->json(['increasement'=>'']);
    }

    public function decreaseQuantity($rowId){
        $cartItem = Cart::get($rowId);
        $updated = Cart::update($rowId, $cartItem->qty-1);
        return response()->json(['decreasement'=>'']);
    }
    public function calculateTotal(){
        $priceTotal = Cart::priceTotal();
        $total = Cart::total();
        if(session('coupon')){
            $coupon = session('coupon')['code'];
            // apply coupon for add new product after apply coupon before
            $couponDiscount = session('coupon')['discount'];
            Cart::setGlobalDiscount($couponDiscount);
            $totalDiscount = Cart::discount();

            return response()->json([
                'priceTotal' =>$priceTotal,
                'coupon'=>$coupon,
                'totalDiscount'=>$totalDiscount,
                'total'=>$total
            ]);
        }else{
            return response()->json([
                'priceTotal' =>$priceTotal,

                'total'=>$total
            ]);
        }

    }
    public function addCoupon(Request $request){
        $coupon = Coupon::where('code',$request->couponName)->first();

        if($coupon){
            $discountPercentage =  $coupon->discount;
            Cart::setGlobalDiscount($discountPercentage);
            Session::put('coupon',[
                'code'=>$coupon->code,
                'discount'=>$coupon->discount
            ]);
            return response()->json(['success'=>'Thêm mã giảm giá thành công']);
        }else{
            Session::forget('coupon');
            Cart::setGlobalDiscount(0);
            return response()->json(['error'=>'Mã giảm giá không khả dụng']);
        }


    }
    public function removeCoupon(){
        Session::forget('coupon');
        Cart::setGlobalDiscount(0);
        return response()->json(['success'=>'Đã xóa mã giảm giá']);
    }
}
