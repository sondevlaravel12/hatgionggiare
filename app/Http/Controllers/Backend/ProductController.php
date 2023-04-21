<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }
    public function create(){
        return view('admin.product.create');
    }
    // public function store(Request $request){
    //     $validated = $request->validate([
    //         'name' => 'required|min:2|max:255',
    //         'code' => 'required|min:2|max:255',
    //         'discount' => 'required|min:1|max:100',
    //         'expiry' => 'required',
    //     ]);
    //     $input = $request->except([]);
    //     $input['code'] = strtoupper( $input['code']);


    //     if($product = Product::create($input)){
    //         $notifycation = [
    //             'message' => 'Thêm mới product thành công',
    //             'alert-type' =>'success'
    //         ];
    //         return redirect()->route('admin.products.index')->with($notifycation);
    //     }
    // }

    public function edit(Product $product){
        return view('admin.product.edit', compact('product'));
    }
    // public function update(product $product, Request $request){
    //     $validated = $request->validate([
    //         'name' => 'required|min:2|max:255',
    //         'code' => 'required|min:2|max:255',
    //         'discount' => 'required|min:1|max:100',
    //         'expiry' => 'required',
    //     ]);
    //     $input = $request->except([]);
    //     $input['code'] = strtoupper( $input['code']);

    //     $product->update($input);

    //     $notifycation = [
    //         'message' => 'Cập nhật product thành công',
    //         'alert-type' =>'success'
    //     ];
    //     return redirect()->route('admin.products.index')->with($notifycation);
    // }
    public function destroy(Product $product){
        $product->delete();
        $notification = [
            'message' => 'xóa sản phẩm thành công',
            'alert-type' =>'success'
        ];
        return back()->with($notification );
    }

    public function ajaxDelete(Request $request){
        $invoice = Product::whereId($request->productID)
        ->first();
        if($invoice->delete()){
            return response()->json(['message'=>'xóa sản phẩm thành công']);
        }
        return response()->json(['error'=>'some errors']);

    }
}
