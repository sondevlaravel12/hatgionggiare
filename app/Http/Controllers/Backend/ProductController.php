<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sample;
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

        $input = $request->except(['photos','category_id','sample_id']);


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
            // add relationship with sample
            if($request->sample_id){
                $sample = Sample::findOrFail($request->sample_id);
                if($sample){
                    $product->sample()->save($sample);
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
         // Get all media files in the 'products' collection for the product
         $preloaded = [];
         foreach ($product->getMedia('products') as $media) {
             $preloaded[] = [
                 'id' => $media->id,
                 'src' => $media->getUrl(),
             ];
         }
         // Render the edit product view with the product data and media IDs
        return view('admin.product.edit', [
            'product'=>$product,
            'categories'=>$categories,
            'preloaded'=>$preloaded,
        ]);
    }
    public function update(product $product, Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'base_price'=>'required|numeric',
            'discount_price'=>'required|numeric',
            // 'category_id' => 'required',
            'description' => 'required|min:10',
            // 'specification'=>'min:10',
            // 'photos'=> [
            //     'image',
            //     'mimes:jpg,jpeg,png,gif',
            // ]
            'category_id' => "nullable|exists:categories,id"
        ]);

        $input = $request->except(['photos','category_id','preloadedImages','deletedImages']);
        // dd($input);
        // dd($request->all());
        // update some text, num inputs
        $product->update($input);

        // delete the images that were in $mediaCollection but not in  $preloadedIds
        $preloadedIds = array_flatten($request->input('preloadedImages', []));
        $mediaCollection = $product->getMedia('products');
        $mediaIds = $mediaCollection->pluck('id')->toArray();
        $idsToDelete = array_diff($mediaIds, $preloadedIds);

        foreach ($mediaCollection as $media) {
            if (in_array($media->id, $idsToDelete)) {
                $media->delete();
            }
        }
         // Upload the new images, if any
         if($request->hasFile('photos')){
            foreach($request->file('photos') as $photo){
                if($photo->isValid()){
                    $product->addMedia($photo)->toMediaCollection('products','productFiles');
                }
            }
        }
        // update category
        // Check if a new category is selected by the user
        $selectedCategoryId = $request->input('category_id');
        if ($selectedCategoryId && $selectedCategoryId !== $product->category_id){
            $category = Category::findOrFail($selectedCategoryId);
            // Update product category
            $product->category()->associate($category)->save();
        }
        elseif (!$product->category) {
            // If no category is selected by the user and the product has no category by default, set category to null
            $product->category()->dissociate()->save();
        }

        $notifycation = [
            'message' => 'Cập nhật product thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.products.index')->with($notifycation);
    }
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
