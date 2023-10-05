<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::orderBy('id','desc')->take(20)->get();
        return view('admin.tag.index', compact('tags'));
    }

    public function edit(Tag $tag){

        return view('admin.product.edit', compact('tag'));
    }
    public function ajaxUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);
        if($request->id && $request->name){
            $tag = Tag::find($request->id);
            if($tag->update(['name'=>$request->name])){
                return response()->json(['message'=>'cập nhật tag thành công']);
            }
            // return response()->json(['message'=>$tag->name]);

        }
        elseif($request->isCreate ='yes'){
            if(Tag::create(['name'=>$request->name])){
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
}
