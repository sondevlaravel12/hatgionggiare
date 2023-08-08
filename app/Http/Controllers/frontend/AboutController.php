<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $about = About::latest()->first();
        $mostDiscountedProducts = Product::getDiscountProducts(8);
        return view('frontend.about', compact('about','mostDiscountedProducts'));

    }
}
