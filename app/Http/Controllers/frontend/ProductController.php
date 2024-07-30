<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Traits\SeoCustomize;
// use Spatie\Tags\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use SeoCustomize;
    public function show(Product $product){
        $this->setupSeoWithModel($product);
        // SEOMeta::setDescription($product->metatag->description);
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
    public function search(Request $request){
        SEOMeta::setTitle('Trang Tìm Kiếm');
        // SEOTools::setTitle('Home');
        SEOTools::setDescription('Ket qua tim kiem san pham voi tu khoa: ' . $request['q']);
        OpenGraph::setTitle('Tìm kiếm sản phẩm');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'product');
        OpenGraph::addProperty('locale', 'vi_VN');


        JsonLd::setTitle('Tìm kiếm sản phẩm');
        JsonLd::setType('Product');

        $validated = $request->validate([
            'q' => 'required|max:20',
        ]);
        $key = $request['q'];
        $products = Product::where('name','like','%' .$key .'%')->orderBy('id', 'DESC')->paginate(24)->withQueryString();

        return view('frontend.product.search', compact('key','products' ));

    }
    public function ajaxSearch(Request $request){
        if( empty($request['term']) ){
            return false;
        }

        $key = $request['term'];

        $products = Product::where('name','like','%' .$key .'%')->limit(10)->get();
        if( $products->count()<1 ){
            exit;
        }

        foreach($products as $product){
            $result[] =
                array(
                    'label' => $product->name,
                    'url'=>route('products.show', $product),
                    'price'=> $product->price,
                    'avatar'=> $product->getFirstImageUrl()
                );
        }

        return response()->json($result);
    }
    public function ajaxSearchNothaveMetatag(Request $request){
        if( empty($request['term']) ){
            return false;
        }

        $key = $request['term'];

        $products = Product::where('name','like','%' .$key .'%')->doesntHave('metatag')->limit(10)->get();
        if( $products->count()<1 ){
            exit;
        }

        foreach($products as $product){
            $result[] =
                array(
                    'label' => $product->name,
                    'model_id'=>$product->id,
                    'model_type'=>'App\Models\Product',
                );
        }

        return response()->json($result);
    }

}
