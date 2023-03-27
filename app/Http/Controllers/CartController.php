<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function ajaxAddtoCart(Request $request){

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        Cart::add($product, $quantity,['image'=>$product->getFirstImageUrl('medium')]);
        return response()->json(['success'=>"Thêm sản phẩm vào giỏ hàng thành công"]);
    }
    public function ajaxFillinMiniCart(){
        $contents = Cart::content();
    	$quantity = Cart::count();
    	$priceTotal = Cart::priceTotal();

    	return response()->json(array(
    		'contents' => $contents,
    		'quantity' => $quantity,
    		'priceTotal' => $priceTotal,

    	));
    }
    public function ajaxRemoveMiniCartItem($rowId){
        Cart::remove($rowId);
    	return response()->json(['success' => 'xóa sản phẩm trong giỏ hàng thành công']);
    }
}
