<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::latest()->limit(3)->get();
        $products = Product::latest()->limit(12)->get();
        $mostDiscountedProducts = Product::getDiscountProducts();

        return view('frontend.index', compact(['products', 'categories','mostDiscountedProducts']));
    }
    public function show($id){
        // $product = Product::findOrFail($id);
        // return view('frontend.product.detail', compact('product'));
        echo $id;
    }
}
