<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pcategory;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }
    public function create(){
        $categories = Pcategory::latest()->get();
        return view('admin.post.create', compact('categories'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:50|max:100',
            'description' => 'required|min:110|max:110000',
            'excerpt'=>'min:20|max:50',
            'photos'=>'required|array'
        ]);

        $input = $request->except(['photos','category_id','_token']);


        if($post = Post::create($input)){
            // add default excerpt
            if($post->excerpt==""){
                $post->setDefaultValueForPostExcerpt();
                $post->save();
            }
            // add relationship with category
            if(is_numeric($request->category_id)){
                $pcategory = Pcategory::findOrFail($request->category_id);
                if($pcategory){
                    $pcategory->posts()->save($post);
                }
            }
            // add media
            foreach($request->file('photos') as $photo){
                $post->addMedia($photo)->toMediaCollection('posts','postFiles');
            }
        }

        $notifycation = [
            'message' => 'post Create successfully',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.posts.index')->with($notifycation);
    }

    // public function edit(Product $product){
    //     $categories = Category::latest()->get();
    //      // Get all media files in the 'products' collection for the product
    //      $preloaded = [];
    //      foreach ($product->getMedia('products') as $media) {
    //          $preloaded[] = [
    //              'id' => $media->id,
    //              'src' => $media->getUrl(),
    //          ];
    //      }
    //      // Render the edit product view with the product data and media IDs
    //     return view('admin.product.edit', [
    //         'product'=>$product,
    //         'categories'=>$categories,
    //         'preloaded'=>$preloaded,
    //     ]);
    // }
    // public function update(product $product, Request $request){
    //     $validated = $request->validate([
    //         'name' => 'required|min:2|max:255',
    //         'base_price'=>'required|numeric',
    //         'discount_price'=>'required|numeric',
    //         // 'category_id' => 'required',
    //         'description' => 'required|min:10',
    //         // 'specification'=>'min:10',
    //         // 'photos'=> [
    //         //     'image',
    //         //     'mimes:jpg,jpeg,png,gif',
    //         // ]
    //         'category_id' => 'nullable|exists:categories,id',
    //     ]);

    //     $input = $request->except(['photos','category_id','preloadedImages','deletedImages']);
    //     // update some text, num inputs
    //     $product->update($input);

    //     // delete the images that were in $mediaCollection but not in  $preloadedIds
    //     $preloadedIds = array_flatten($request->input('preloadedImages', []));
    //     $mediaCollection = $product->getMedia('products');
    //     $mediaIds = $mediaCollection->pluck('id')->toArray();
    //     $idsToDelete = array_diff($mediaIds, $preloadedIds);

    //     foreach ($mediaCollection as $media) {
    //         if (in_array($media->id, $idsToDelete)) {
    //             $media->delete();
    //         }
    //     }
    //      // Upload the new images, if any
    //      if($request->hasFile('photos')){
    //         foreach($request->file('photos') as $photo){
    //             if($photo->isValid()){
    //                 $product->addMedia($photo)->toMediaCollection('products','productFiles');
    //             }
    //         }
    //     }
    //     // update category
    //     // Check if a new category is selected by the user
    //     $selectedCategoryId = $request->input('category_id');
    //     if ($selectedCategoryId && $selectedCategoryId !== 'not_selected' && $selectedCategoryId !== $product->category_id){
    //         $category = Category::findOrFail($selectedCategoryId);
    //         // Update product category
    //         $product->category()->associate($category)->save();
    //     } elseif (!$product->category) {
    //         // If no category is selected by the user and the product has no category by default, set category to null
    //         $product->category()->dissociate()->save();
    //     }

    //     $notifycation = [
    //         'message' => 'Cập nhật product thành công',
    //         'alert-type' =>'success'
    //     ];
    //     return redirect()->route('admin.products.index')->with($notifycation);
    // }
    // public function destroy(Product $product){
    //     $product->delete();
    //     $notification = [
    //         'message' => 'xóa sản phẩm thành công',
    //         'alert-type' =>'success'
    //     ];
    //     return back()->with($notification );
    // }

    public function ajaxDelete(Request $request){
        $invoice = Post::whereId($request->postID)
        ->first();
        if($invoice->delete()){
            return response()->json(['message'=>'xóa bài viết thành công']);
        }
        return response()->json(['error'=>'some errors']);

    }
}
