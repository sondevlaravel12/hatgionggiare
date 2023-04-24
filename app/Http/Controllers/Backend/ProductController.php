<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }
    public function create(){
        $categories = Category::latest()->get();
        return view('admin.product.create', compact('categories'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'base_price'=>'required',
            'discount_price'=>'required',
            // 'category_id' => 'required',
            'description' => 'required|min:10',
            // 'specification'=>'min:10',
            // 'photos'=> [
            //     'image',
            //     'mimes:jpg,jpeg,png,gif',
            // ]
        ]);
        // dd($request->file('photos'));

        $input = $request->except(['photos','category_id']);


        if($product = Product::create($input)){
            if($request->category_id!='not_selected'){
                $category = Category::findOrFail($request->category_id);
                if($category){
                    $category->products()->save($product);
                }
            }

            if($request->hasFile('photos')){
                foreach($request->file('photos') as $photo){
                    // dd($photo);
                    // if($photo->isValid()){
                        $product->addMedia($photo)->toMediaCollection('products','productFiles');
                    // }
                }
            }

            $notifycation = [
                'message' => 'Product Create successfully',
                'alert-type' =>'success'
            ];
            return redirect()->route('admin.products.index')->with($notifycation);
        }
    }

    public function edit(Product $product){
        $categories = Category::latest()->get();
        return view('admin.product.edit', compact('product','categories'));
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
