<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Oproduct;
use App\Models\Sample;
use Illuminate\Http\Request;

class OproductController extends Controller
{
    public function index(){
        $oproducts = Oproduct::all();
        return view('superadmin.original_product.index', compact('oproducts'));
    }
    public function ajaxAddnewOproduct(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);
        $oproductName = $request->name;
        $newOproduct = Oproduct::create(['name'=>$oproductName]);
        if($newOproduct){
            $response = [
                'message'=>'Thêm sản phẩm gốc mới thành công',
                'alert-type'=>'success',
                'newOproduct'=>$newOproduct
            ];
            return response()->json($response);
        }
    }
    public function ajaxGetOproductInfo(Request $request){
        $oproduct = Oproduct::find($request->id);
        if($oproduct){
            $response = [
                'id'=>$oproduct->id,
                'name'=>$oproduct->name
            ];
            return response()->json($response);
        }
    }
    public function ajaxUpdateOproductInfo(Request $request){
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required|min:2|max:255',
        ]);
        $oproduct = Oproduct::find($request->id);
        $oproductName = $request->name;

        if($oproduct->update(['name'=>$oproductName])){
            $response = [
                'message'=>'cập nhật sản phẩm thành công',
                'alert-type'=>'success'
            ];
            return response()->json($response);
        }
    }
    public function ajaxRemoveOproduct(Request $request){
        $oproduct = Oproduct::find($request->id);
        if($oproduct->delete()){
            $response = [
                'message'=>'xóa sản phẩm gốc thành công',
                'alert-type'=>'success'
            ];
            return response()->json($response);
        }
    }
    public function sampleByOproduct(Request $request){
        $samples = Sample::all();
        return view('superadmin.original_product.sample_by_oproduct', compact('samples'));
    }
}
