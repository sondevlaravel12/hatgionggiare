<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        return view('cart.index');
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
            return response()->json(['error'=>'Mã giảm giá không khả dụng']);
        }


    }
}
