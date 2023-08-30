<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;


class WishlistController extends Controller
{
    public function ajaxAddToWishlist($productid){
        //$product = Product::findOrFail($productid);
        if(Auth::check()){
            $itemExist = Wishlist::where('user_id',Auth::user()->id)->where('product_id', $productid)->first();
            if(!$itemExist){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $productid,
                    'created_at' => Carbon::now(),
                ]);
            }
            return response()->json(['success'=>'sản phẩm thêm vào danh sách yêu thích thành công']);

        }else{
            return response()->json(['error'=>'bạn cần phải đăng nhập trước khi thêm sản phẩm vào danh sách yêu thích']);

        }


    }
    public function index(){
        $wishlistItems = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return view('frontend.wishlist.index', compact('wishlistItems'));
    }
    public function indexAjaxShowWishlishItem(){
        $wishlistItems = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        $images = [];
        foreach($wishlistItems as $key=>$value){
            $product = $value->product;
            $images[$key] = $product->getFirstImageUrl();
        }
        return response()->json(['wishlistItems'=>$wishlistItems, 'images'=>$images]);
    }
    public function removeWishlistItem($wishlistId){
        $wishlist = Wishlist::where('user_id',Auth::id())->where('id',$wishlistId)->first();
        $productId = $wishlist->product->id;
        $wishlist->delete();
        return response()->json(['success'=>'xóa sản phẩm thành công','productId'=>$productId]);
    }
    public function moveToCart($wishlistId){
        $wishlist = Wishlist::where('user_id',Auth::id())->where('id',$wishlistId)->first();
        if($product = $wishlist->product){
            $quantity = 1;
            Cart::add($product, $quantity,['image'=>$product->getFirstImageUrl('medium')]);
            $wishlist->delete();
            return response()->json(['success'=>'di chuyển sản phẩm vào giỏ hàng thành công']);
        }

    }
}
