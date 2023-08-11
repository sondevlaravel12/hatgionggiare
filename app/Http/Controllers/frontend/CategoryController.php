<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->limit(3)->get();
        $products = Product::latest()->paginate(12);
        return view('frontend.category.index', compact('products','categories'));
    }
    public function show(Category $category){
        // $categories = Category::latest()->limit(3)->get();
        $products = $category->products->toQuery()->paginate(12);
        return view('frontend.category.detail',compact('category','products'));
    }
}
