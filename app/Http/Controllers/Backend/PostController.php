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
            'excerpt'=>'nullable|min:80|max:600',
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

    public function edit(Post $post){
        $categories = Pcategory::latest()->get();
         // Get all media files in the 'posts' collection for the post
         $preloaded = [];
         foreach ($post->getMedia('posts') as $media) {
             $preloaded[] = [
                 'id' => $media->id,
                 'src' => $media->getUrl(),
             ];
         }
        return view('admin.post.edit',compact('categories','post','preloaded'));
    }
    public function update(Post $post, Request $request){
        $validated = $request->validate([
            'title' => 'required|min:50|max:100',
            'description' => 'required|min:110|max:110000',
            'excerpt'=>'nullable|min:80|max:600',
            // 'photos'=>'required|array'
        ]);
        // dd($request->all());

        $input = $request->except(['photos','category_id','preloadedImages','deletedImages']);
        // update some text, num inputs
        $post->update($input);

        // delete the images that were in $mediaCollection but not in  $preloadedIds
        $preloadedIds = array_flatten($request->input('preloadedImages', []));
        $mediaCollection = $post->getMedia('posts');
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
                    $post->addMedia($photo)->toMediaCollection('posts','postFiles');
                }
            }
        }
        // update category
        // Check if a new category is selected by the user
        $selectedCategoryId = $request->input('category_id');
        // if selected different category then update the relationship, if not do nothing
        if ($selectedCategoryId && is_numeric($selectedCategoryId) && $selectedCategoryId != $post->category_id){
            $category = Pcategory::findOrFail($selectedCategoryId);
            // Update product category
            $post->pcategory()->associate($category)->save();
        }

        $notifycation = [
            'message' => 'Cập nhật bài viết thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.posts.index')->with($notifycation);
    }
    // public function destroy(Post $post){
    //     $post->delete();
    //     $notification = [
    //         'message' => 'xóa bài viết thành công',
    //         'alert-type' =>'success'
    //     ];
    //     return back()->with($notification );
    // }

    public function ajaxDelete(Request $request){
        $post = Post::whereId($request->postID)
        ->first();
        if($post->delete()){
            return response()->json(['message'=>'xóa bài viết thành công']);
        }
        return response()->json(['error'=>'some errors']);

    }
    public function ajaxSetPublished(Request $request){
        $post = Post::whereId($request->post_id)->first();
        $status = $request->status;
        if($post){
            // change status
            $post->status = $status;
            $post->save();
            if($status==1){
                return response()->json(['message'=>'xuất bản bài viết thành công']);
            }else{
                return response()->json(['message'=>'ngừng xuất bản bài viết thành công']);
            }
        }else{
            return response()->json(['error'=>'some errors']);
        }

    }
}
