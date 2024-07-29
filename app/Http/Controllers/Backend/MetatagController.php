<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Metatag;
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
}
