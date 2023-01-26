<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

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
}
