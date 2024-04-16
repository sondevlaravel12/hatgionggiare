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
    public function search(Request $request){
        $term = $request->term;
        $results = Oproduct::search($term );
        // do i need product id in json array?
        return response()->json($results);
    }
    public function ajaxSearchRelativeSamples(Request $request){
        $arrayOproductId = $request->arrayOproductId;
        $samples = Sample::whereIn('oproduct_id',$arrayOproductId)->with('oproduct')->latest()->get();
        return response()->json($samples);
    }
    // public function ajaxSearchByName(Request $request){
    //     $oproductName = $request->oproductName;
    //     $oproduct = Oproduct::where('name','=',$oproductName)->first();
    //     if($oproduct){
    //         return response()->json($oproduct);
    //     }else{
    //         $response = [
    //             'message'=>'search failed',
    //             'alert-type'=>'success'
    //         ];
    //         return response()->json($response);
    //     }
    // }
    public function select2SearchByName(Request $request){
        $oproductName = $request->input('term', '');
        $oproducts = Oproduct::where('name','like', '%'.$oproductName .'%')->get(['id','name as text']);
        return ['results' => $oproducts];
    }
}
