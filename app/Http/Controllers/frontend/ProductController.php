<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
// use Spatie\Tags\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product){
        // $this->fetchSideBar();
        $bestSellings = Product::where('best_selling',1)->limit(6)->get();
        return view('frontend.product.detail')->with([
            'product'=>$product,
            'bestSellings'=>$bestSellings
        ]);
    }
    public function productsByTag(Tag $tag){
        // $this->fetchSideBar();
        return view('frontend.tag.products_by_tag')->with([
            'products'=>$tag->products->toQuery()->paginate(12),
            //do later overide data: get all category that has child and child also has product
            'tag'=>$tag
        ]);
    }
    public function ajaxModalShow($id){
        $product = Product::findOrFail($id);
        $imageUrl = $product->getFirstImageUrl('medium');

        return response()->json(['product'=> $product, 'imageUrl'=>$imageUrl]);
    }
}
