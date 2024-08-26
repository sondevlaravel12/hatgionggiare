<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;


class WishlistController extends Controller
{

    public function ajaxAddToWishlist($productId)
    {

        // Sử dụng Cart với instance là 'wishlist'
        $product = Product::findOrFail($productId);

        // Thêm sản phẩm vào wishlist
        // Cart::instance('wishlist')->add($product->id, $product->name, 1);
        Cart::instance('wishlist')->add($product, 1,['image'=>$product->getFirstImageUrl('medium'),'slug'=>$product->slug]);

        if (Auth::check()) {
            // Người dùng đã đăng nhập, sử dụng user ID làm identifier
            $identifier = Auth::id();
            // Lưu lại wishlist vào database hoặc session
            $this->updateWishlistDb($identifier);
        }

        return response()->json(['success' => 'Thêm sản phẩm vào danh sách yêu thích thành công']);
    }


    public function index(){
        $wishlistItems = Cart::instance('wishlist')->content();

    	// $quantity = Cart::count();
    	// $subtotal = Cart::subtotal();

    	// return response()->json(array(
    	// 	'contents' => $contents,
    	// 	// 'quantity' => $quantity,
    	// 	// 'subtotal' => $subtotal
    	// ));
        // $wishlistItems =
        // dd($wishlistItems);
        return view('frontend.wishlist.index', compact('wishlistItems'));
    }
    public function indexAjaxShowWishlishItem(){
        // $wishlistItems = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        $wishlistItems = Cart::instance('wishlist')->content();
        $images = [];
        $products= array();
        foreach($wishlistItems as $key=>$value){
            $product = $value->model;
            $images[$key] = $product->getFirstImageUrl();
            $products[$key]=Product::find($product->id,['name', 'slug','price','discount_price','base_price']);

        }
        return response()->json(['wishlistItems'=>$wishlistItems, 'images'=>$images,'products'=>$products]);
    }

    public function removeWishlistItem($rowId){
        // $wishlist = Wishlist::where('user_id',Auth::id())->where('id',$wishlistId)->first();
        // $productId = $wishlist->product->id;
        // $wishlist->delete();
        Cart::instance('wishlist')->remove($rowId);
        if (Auth::check()) {
            // Lưu lại wishlist vào database
            $this->updateWishlistDb(Auth::id());
        }
        return response()->json(['success'=>'xóa sản phẩm thành công']);
    }
    private function updateWishlistDb($identifier){
        Cart::instance('wishlist')->erase($identifier);
        Cart::instance('wishlist')->store($identifier);
    }
    public function moveToCart($rowId){
        // $wishlist = Wishlist::where('user_id',Auth::id())->where('id',$wishlistId)->first();
        $wishlistItem = Cart::instance('wishlist')->get($rowId);

        if($product = $wishlistItem->model){
            // dd('hi');
            $quantity = 1;
            Cart::instance('default')->add($product, $quantity,['image'=>$product->getFirstImageUrl('medium'),'slug'=>$product->slug]);
            // Cart::instance('wishlist')->remove($rowId);
            return response()->json(['success'=>'di chuyển sản phẩm vào giỏ hàng thành công']);
        }

    }
    public function synceWishlistFromSessionToUser($userId)
    {
        // Khôi phục wishlist từ session
        $sessionWishlist = Cart::instance('wishlist')->content();

        // Nếu người dùng đã có wishlist trong cơ sở dữ liệu
        Cart::instance('wishlist')->restore($userId);

        // Hợp nhất session wishlist với wishlist từ cơ sở dữ liệu
        foreach ($sessionWishlist as $item) {
            $product = $item->model;
            Cart::instance('wishlist')->add($product, 1,['image'=>$product->getFirstImageUrl('medium'),'slug'=>$product->slug]);
        }

        // Xóa nội dung hiện tại trong cơ sở dữ liệu
        Cart::instance('wishlist')->erase($userId);

        // Lưu lại nội dung wishlist mới hợp nhất vào cơ sở dữ liệu
        Cart::instance('wishlist')->store($userId);

        // Xóa session wishlist vì giờ đã được lưu trong database
        // Cart::instance('wishlist')->destroy();
    }
}
