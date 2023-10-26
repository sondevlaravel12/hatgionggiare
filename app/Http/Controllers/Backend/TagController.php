<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::orderBy('id','desc')->take(20)->get();
        return view('admin.tag.index', compact('tags'));
    }
    public function tagToProduct(){
        // $products = Product::with('tags')->latest()->get();
        $products = Product::all();
        // $tags = Tag::all();
        return view('admin.tag.tag_to_product', compact('products'));
    }

    public function edit(Tag $tag){

        return view('admin.product.edit', compact('tag'));
    }
    public function ajaxUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);
        // using for tag to product
        if($request->id && $request->name){
            $tag = \Spatie\Tags\Tag::find($request->id);
            $tag->name = $request->name;
            if($tag->save()){
                return response()->json(['message'=>'tag sản phẩm thành công']);
            }else{
                return response()->json(['message'=>'something went wrong','alert-type'=>'error']);
            }

        }
        // using for creating new tag
        elseif($request->isCreate ='yes'){
            if(\Spatie\Tags\Tag::create(['name'=>$request->name])){
                return response()->json(['message'=>'thêm tag mới thành công']);
            }
        }
        else{
            return response()->json(['message'=>'cập nhật tag thất bại']);
        }
    }

    public function ajaxDestroy(Request $request){
        if($request->id){
            $tag = Tag::find($request->id);
            if($tag->delete()){
                return response()->json(['message'=>'xóa tag thành công']);
            }

        }else{
            return response()->json(['error'=>'xóa tag thất bại']);
        }
    }
    public function destroy(Tag $tag){
        $tag->delete();
        $notification = [
            'message' => 'xóa tag thành công',
            'alert-type' =>'success'
        ];
        return back()->with($notification );
    }
    public function tagSearch(Request $request){
        $term = $request->term;
        $results = Tag::search($term );
        // do i need product id in json array?
        return response()->json($results);
    }
    public function ajaxAddToProduct(Request $request){
        $validated = $request->validate([
            'productId' => 'required',
            'newTag' => 'required|min:2|max:255',
        ]);
        $product = Product::find($request->productId);
        $tag = \Spatie\Tags\Tag::findOrCreate($request->newTag);
        if($product->attachTag($tag)){
            return response()->json(['message'=>'tag sản phẩm thành công','alert_type'=>'success']);
        }else{
            return response()->json(['message'=>'tag sản phẩm thất bại','alert_type'=>'error']);
        }

    }
    public function ajaxDetachToProduct(Request $request){
        $product = Product::find($request->productId);
        $tag = \Spatie\Tags\Tag::findOrCreate($request->tag);
        if($product->detachTag($tag)){
            return response()->json(['message'=>'bỏ liên kết tag thành công']);
        }
    }
    public function ajaxGetTagInfo(Request $request){
        $tag = Tag::find($request->id);
        if($tag){
            $response = [
                'id'=>$tag->id,
                'name'=>$tag->name
            ];
            return response()->json($response);
        }
    }
    public function ajaxUpdateTagInfo(Request $request){
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required|min:2|max:255',
        ]);
        $tag = Tag::find($request->id);
        $tagName = $request->name;

        if($tag->update(['name'=>$tagName])){
            $response = [
                'message'=>'cập nhật tag thành công',
                'alert-type'=>'success'
            ];
            return response()->json($response);
        }
    }
    public function ajaxRemoveTag(Request $request){
        $tag = Tag::find($request->id);
        if($tag->delete()){
            $response = [
                'message'=>'xóa tag thành công',
                'alert-type'=>'success'
            ];
            return response()->json($response);
        }
    }

    public function ajaxAddNewTag(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);
        $tagName = $request->name;
        $spatieTag = \Spatie\Tags\Tag::create(['name'=>$tagName]);
        $newTag = Tag::find($spatieTag['id']);
        if($newTag){
            $response = [
                'message'=>'Thêm tag mới thành công',
                'alert-type'=>'success',
                'tag'=>$newTag
            ];
            return response()->json($response);
        }
    }
}
