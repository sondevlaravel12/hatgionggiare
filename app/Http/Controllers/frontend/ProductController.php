<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function show(Product $product){
        $this->fetchSideBar();
        $bestSellings = Product::where('best_selling',1)->limit(6)->get();
        return view('frontend.product.detail')->with([
            'products'=>$this->products,
            'categories'=>$this->categories,
            'parentCategories'=>$this->parentCategories,
            'populerProducts'=>$this->populerProducts,
            'recentProducts'=>$this->recentProducts,
            'productTags'=>$this->productTags,
            'hotDeals'=>$this->hotDeals,
            'product'=>$product,
            'bestSellings'=>$bestSellings
        ]);
    }
    public function productsByTag(Tag $tag){
        $this->fetchSideBar();
        return view('frontend.tag.products_by_tag')->with([
            'products'=>$tag->products->toQuery()->paginate(12),
            'categories'=>$this->categories,
            'parentCategories'=>$this->parentCategories,
            'populerProducts'=>$this->populerProducts,
            'recentProducts'=>$this->recentProducts,
            'productTags'=>$this->productTags,
            'hotDeals'=>$this->hotDeals,
            'tag'=>$tag
        ]);
    }
    public function ajaxModalShow($id){
        $product = Product::findOrFail($id);
        $imageUrl = $product->getFirstImageUrl('medium');

        return response()->json(['product'=> $product, 'imageUrl'=>$imageUrl]);
    }
}
