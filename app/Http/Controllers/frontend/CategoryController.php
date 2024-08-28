<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Traits\SeoCustomize;


class CategoryController extends Controller
{
    use SeoCustomize;
    public function index(){
        $products = Product::latest()->paginate(12);
        $this->setupSeoWithoutModel('allProducts');
        return view('frontend.category.index')->with([
            'products'=>$products,
        ]);
    }
    public function show(Category $category){
        if($category->products->count()>0){
            $this->setupSeoWithModel($category);
            $products = $category->products->toQuery()->paginate(12);
            return view('frontend.category.detail')->with([
                'products'=>$products,
                'category'=>$category
            ]);
        }else{
            // return back()->withErrors('Danh Mục Này Không Có Sản Phẩm');
            return view('frontend.category.detail')->with([
                'error'=>'Danh Mục Này Không Có Sản Phẩm',
                'category'=>$category
            ]);
        }
    }
}
