<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product){
        //$product = Product::findOrFail($id);
        $bestSellings = Product::where('best_selling',1)->limit(6)->get();
        return view('frontend.product.detail', compact('product','bestSellings'));
    }
}
