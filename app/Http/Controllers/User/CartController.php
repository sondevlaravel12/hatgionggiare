<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Webinfo;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // private $shoppingCart= Cart::instance('default');
    public function index(){
        $contents = Cart::content();
        // dd($contents);
    	$quantity = Cart::count();
    	$subtotal = Cart::subtotal();

        return view('cart.index', compact(['contents','quantity','subtotal']));
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
    public function ajaxAddtoCart(Request $request){

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        Cart::add($product, $quantity,['image'=>$product->getFirstImageUrl('medium'),'slug'=>$product->slug]);
        if (Auth::check()) {
            // Lưu lại wishlist vào database
            $this->updateCartDb(Auth::id());
        }
        $dataForDataLayer = ['item_name'=>$product->name,
                                'item_category'=>$product->category?$product->category->name:'',
                                'item_price'=>$product->getRawOriginal('discount_price'),
                                'quantity'=>$quantity
                            ];
        return response()->json(['success'=>"Thêm sản phẩm vào giỏ hàng thành công",
                                'dataForDataLayer'=>$dataForDataLayer

                                ]);
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
        if (Auth::check()) {
            // Lưu lại wishlist vào database
            $this->updateCartDb(Auth::id());
        }
    	return response()->json(['success' => 'xóa sản phẩm trong giỏ hàng thành công']);
    }
    public function removeCartItem($itemId){
        Cart::remove($itemId);
        if (Auth::check()) {
            // Lưu lại wishlist vào database
            $this->updateCartDb(Auth::id());
        }
        if(Cart::count()==0){
            Session::forget('coupon');
        }
        return response()->json(['success'=>'xóa sản phẩm thành công']);
    }
    public function increaseQuantity($rowId){
        $cartItem = Cart::get($rowId);
        $updated = Cart::update($rowId, $cartItem->qty+1 );
        if (Auth::check()) {
            // Lưu lại wishlist vào database
            $this->updateCartDb(Auth::id());
        }
        return response()->json(['increasement'=>'']);
    }

    public function decreaseQuantity($rowId){
        $cartItem = Cart::get($rowId);
        $updated = Cart::update($rowId, $cartItem->qty-1);
        if (Auth::check()) {
            // Lưu lại wishlist vào database
            $this->updateCartDb(Auth::id());
        }
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
            if ($coupon->isExpired()) {
                return response()->json(['error'=>'Mã giảm giá đã hết hạn']);
            }else{
                $discountPercentage =  $coupon->discount;
                Cart::setGlobalDiscount($discountPercentage);
                Session::put('coupon',[
                    'code'=>$coupon->code,
                    'discount'=>$coupon->discount
                ]);
                return response()->json(['success'=>'Thêm mã giảm giá thành công']);
            }
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
    private function updateCartDb($identifier){
        Cart::instance('default')->erase($identifier);
        Cart::instance('default')->store($identifier);
    }
    public function synceCartFromSessionToUser($userId)
    {
        // Lấy dữ liệu cart từ session
        $sessionCart = Cart::instance('default')->content();

        // Khôi phục dữ liệu cart từ database
        Cart::instance('default')->restore($userId);
        $dbCart = Cart::instance('default')->content();

        // Hợp nhất dữ liệu cart từ session và database
        foreach ($sessionCart as $item) {
            // Nếu sản phẩm đã tồn tại trong database, cập nhật số lượng
            if ($dbCart->has($item->rowId)) {
                // $existingItem = $dbCart->get($item->rowId);
                // $newQty = $existingItem->qty + $item->qty;
                // Cart::instance('default')->update($item->rowId, $newQty);
            } else {
                // Nếu sản phẩm chưa có, thêm vào database
                // $product, $quantity,['image'=>$product->getFirstImageUrl('medium'),'slug'=>$product->slug]
                Cart::instance('default')->add($item->product, $item->quantity, $item->options);
            }
        }

        // Xóa nội dung hiện tại trong cơ sở dữ liệu
        Cart::instance('default')->erase($userId);

        // Lưu lại nội dung wishlist mới hợp nhất vào cơ sở dữ liệu
        Cart::instance('default')->store($userId);

        // Xóa session wishlist vì giờ đã được lưu trong database
        // Cart::instance('wishlist')->destroy();
    }
}
