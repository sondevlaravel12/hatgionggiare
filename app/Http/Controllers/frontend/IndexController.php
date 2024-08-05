<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OtherInformation;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $title = 'Trang chủ ' . config('constants.BRAND');
        $categories = Category::latest()->limit(3)->get();
        $products = Product::latest()->limit(12)->get();
        $posts = Post::latest()->limit(6)->get();
        $bestSellings = Product::where('best_selling',1)->limit(6)->get();
        $mostDiscountedProducts = Product::getDiscountProducts(8);
        $hideBreadcrumb=true;
        return view('frontend.index', compact(['hideBreadcrumb','products', 'categories','mostDiscountedProducts','bestSellings','posts','title']));
    }
    public function show($id){
        // $product = Product::findOrFail($id);
        // return view('frontend.product.detail', compact('product'));

        echo $id;
    }
    public function showBankInfor(){
        $title = 'Thông tin tài khoản ngân hàng ' . config('constants.BRAND');
        $bankInfor = OtherInformation::where('key','bank_infor')->first();
        return view('frontend.bank_infor', compact('bankInfor','title'));
    }
}
