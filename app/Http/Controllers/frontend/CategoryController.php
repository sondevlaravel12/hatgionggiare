<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $parentCategories,$populerProducts, $recentProducts,$categories,$products,$hotDeals,$productTags;
    private function fetchSideBar(){
        $this->parentCategories = Category::where('parent_id',0)->has('children')->get();
        $this->populerProducts = Product::populer();
        $this->recentProducts = Product::latest()->limit(2)->get();
        $this->categories = Category::latest()->limit(3)->get();
        $this->products = Product::latest()->paginate(12);
        $this->hotDeals = Product::hotDeals();
        $this->productTags = Tag::has('products')->with('products')->take(5)->get();
    }
    public function index(){
        $this->fetchSideBar();
        return view('frontend.category.index')->with([
            'products'=>$this->products,
            'categories'=>$this->categories,
            'parentCategories'=>$this->parentCategories,
            'populerProducts'=>$this->populerProducts,
            'recentProducts'=>$this->recentProducts,
            'productTags'=>$this->productTags,
            'hotDeals'=>$this->hotDeals,
        ]);
    }
    public function show(Category $category){
        $this->fetchSideBar();
        return view('frontend.category.detail')->with([
            'products'=>$this->products,
            'categories'=>$this->categories,
            'parentCategories'=>$this->parentCategories,
            'populerProducts'=>$this->populerProducts,
            'recentProducts'=>$this->recentProducts,
            'productTags'=>$this->productTags,
            'hotDeals'=>$this->hotDeals,
            'category'=>$category
        ]);
    }
}
