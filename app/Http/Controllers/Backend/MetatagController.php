<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Metatag;
use App\Models\Pcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class MetatagController extends Controller
{
    public function index(){
        $metatags = Metatag::orderBy('id','desc')->get();
        return view('admin.metatag.index', compact('metatags'));
    }
    public function attatch(){
        return view('admin.metatag.attatch');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'model_id' => 'required',
            // 'description' => 'required|min:2|max:255',
            // 'discount' => 'required|min:1|max:100',
            // 'expiry' => 'required',
        ]);
        // dd($request->all());
        $input = $request->except(['model_type_switch','model_title']);
        if($input['author']==null)$input['author']='hatgionggiare';
        if($metatag = Metatag::create($input)){
            $notifycation = [
                'message' => 'Thêm mới metatag thành công',
                'alert-type' =>'success'
            ];
            return redirect()->route('admin.metatags.index')->with($notifycation);
        }
    }
    public function storeOther(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'model_id' => 'required',
        ]);
        // dd($request->all());
        $input = $request->except([]);
        if($input['author']==null)$input['author']='hatgionggiare';
        if($metatag = Metatag::create($input)){
            // attatch to model
            // if($request->model_type=='product_category'){
            //     $category = Category::find($request->model_id);
            //     // $productCategory->metatag()->save($metatag);
            //     $metatag->model()->save($category);
            // }elseif($request->model_type=='post_category'){
            //     $postCategory = Pcategory::find($request->model_id);
            //     $postCategory->metatag()->save($metatag);
            // }
            $notifycation = [
                'message' => 'Thêm mới metatag thành công',
                'alert-type' =>'success'
            ];
            return redirect()->route('admin.metatags.index')->with($notifycation);
        }
    }
    public function attatchOther(){
        return view('admin.metatag.attatch_other');
    }
    public function ajaxGetAllItemsOfModel(Request $request){
        $result='';
        if($request->model_type=='App\Models\Category'){
            $result = Category::doesntHave('metatag')->get(['id','name']);
        }elseif($request->model_type=='App\Models\Pcategory'){
            $result = Pcategory::doesntHave('metatag')->get(['id','name']);

        }
        return response()->json($result);
    }
    public function ajaxGetMetatagInfo(Request $request){
        $metatag = Metatag::find($request->id)->load('model');
        // $data=[];
        // if($metatag){
        //     // $response = [
        //     //     'id'=>$metatag->id,
        //     //     'title'=>$metatag->title
        //     // ];
        //     $model=[];
        //     if($metatag->model_type=='App\Models\Product'){
        //         $model=[
        //             'name'=>,
        //             'url'=>route('products.show',$metatag->model_id)
        //         ];
        //     }elseif($metatag->model_type=='App\Models\Post'){
        //         $model=[
        //             'name'=>'post',
        //             'url'=>route('posts.show',$metatag->model_id)
        //         ];
        //     }
        //     $data=[
        //         'model'=>$model,
        //         'metatag'=>$metatag
        //     ];
            return response()->json($metatag);
        // }
    }
    public function ajaxUpdateMetatag(Request $request){
        $metatag = Metatag::find($request->id);
        // $input = $request->accepts(['id']);

        if($metatag->update($request->all())){
            $response = [
                'message'=>'cập nhật metatag thành công',
                'alert-type'=>'success',
                'metatag'=>$metatag,
            ];
            return response()->json($response);
        }
    }
    public function ajaxSearchModel(Request $request){
        // $data = '{
        //     "results": [
        //       {
        //         "id": 1,
        //         "text": "Option 1"
        //       },
        //       {
        //         "id": 2,
        //         "text": "Option 2"
        //       }
        //     ],
        //   }';
        //   if( empty($request['term']) ){
        //     return false;
        // }

        // $key = $request['term'];

        // $products = Product::where('name','like','%' .$key .'%')->limit(10)->get();
        // if( $products->count()<1 ){
        //     exit;
        // }
        $products = Product::limit(10)->get();

        foreach($products as $product){
            $result[] =[
                'id' => $product->id,
                'text'=>$product->name,
            ];
        }
        // $result = $products;
        return response()->json($result);
    }
}
