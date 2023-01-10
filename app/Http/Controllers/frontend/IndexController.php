<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products = Product::latest()->get();

        return view('frontend.index', compact('products'));
    }
    public function show($id){
        // $product = Product::findOrFail($id);
        // return view('frontend.product.detail', compact('product'));
        echo $id;
    }
}
