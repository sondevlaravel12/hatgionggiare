<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pcategory;
use App\Models\Post;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();

        return view('admin.post.index', compact('posts'));
    }
    public function create(){
        $categories = Pcategory::latest()->get();

        // $fullNameDirectories = Storage::disk('public')->directories('photos');
        $fullNameDirectories = Storage::disk('public')->directories('photos');
        $directories =[];
        foreach ($fullNameDirectories as $fullNameDirectorie) {
            // $directories[] = pathinfo($fullNameDirectorie, PATHINFO_DIRNAME);
            $directories[] = explode('/',$fullNameDirectorie)[1];
        }
        return view('admin.post.create', compact('categories','directories'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:10|max:100',
            'description' => 'required|min:110|max:110000',
            'excerpt'=>'nullable|min:80|max:600',
            'photos'=>'required|array'
        ]);

        $input = $request->except(['photos','category_id','_token','directories']);
        // dd($input);


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
            // add relationship with sample
            if($request->sample_id){
                $sample = Sample::findOrFail($request->sample_id);
                if($sample){
                    $post->sample()->save($sample);
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
         // get images from specific directory
        //  $files = Storage::files(url('storage/posts/137'));
        // $files = Storage::disk('public')->allFiles('photos/cuc-nut-ao');
        // $images = [];

        // foreach ($files as $file) {
        //     $images[] = basename($file);
        // }
        $fullNameDirectories = Storage::disk('public')->directories('photos');
        $directories =[];
        foreach ($fullNameDirectories as $fullNameDirectorie) {
            $directories[] = basename($fullNameDirectorie);
        }
        // dd($directories);
        return view('admin.post.edit',compact('categories','post','preloaded','directories'));
    }
    public function update(Post $post, Request $request){
        $validated = $request->validate([
            'title' => 'required|min:10|max:100',
            'description' => 'required|min:110|max:110000',
            'excerpt'=>'nullable|min:80|max:600',
            // 'photos'=>'required|array'
            // test new
        ]);
        // dd($request->all());

        $input = $request->except(['photos','category_id','preloadedImages','deletedImages']);
        // update some text, num inputs
        // dd($input);
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
    public function ajaxGetAllPhotoDirs(){

        $fullNameDirectories = Storage::disk('public')->directories('photos');
        $directories =[];
        foreach ($fullNameDirectories as $fullNameDirectorie) {
            $directories[] = explode('/',$fullNameDirectorie)[1];
        }
        // $directories = ['hạt giống bí đĩa bay trắng', 'cây hoa mua hè', 'Hạt Giống Bầu Hồ Lô', 'Hạt Giống Bắp Cải Tí Hon Tím', 'hat giong test choi', 'shares'];

        // $fullNameDirectories = Storage::disk('public')->directories('photos');
        // $directories =[];
        // $i = 1;
        // foreach ($fullNameDirectories as $fullNameDirectorie) {
        //     $directorie = [
        //         'id'=>$i,
        //         'text'=>basename($fullNameDirectorie)
        //     ];
        //     $directories[] = $directorie;
        //     $i++;
        // }
        return response()->json($directories);
    }
    public function ajaxGetImagesFromDir(Request $request){

        $directory = $request->directory;
        // if($request->isPostType){
        //     $fullNameDirectories = Storage::disk('public')->directories('photos/posts');
        //     $directories =[];
        //     foreach ($fullNameDirectories as $fullNameDirectorie) {
        //         $directories[] = basename($fullNameDirectorie);
        //     }
        //     // return json and fill input

        //     $files = Storage::disk('public')->files('photos/posts/' .$directory);
        //     $images = [];

        //     foreach ($files as $file) {
        //         $images[] = asset('storage/' .$file);
        //     }
        //     return response()->json($images);

        // }else{
            $files = Storage::disk('public')->files('photos/' .$directory);
            $images = [];

            foreach ($files as $file) {
                $images[] = asset('storage/' .$file);
            }
            // return response()->json($images);
        // }

        // dd($files);
        // File::glob('public/photos-textarea/*')

        return response()->json($images);
        // return $images;
    }

    public function ajaxGetDiretoryNameFromFileManager(Request $request){
        $directories =[];
        $path='';
        $request->isPostType=='true'?$path='photos/posts':$path='photos';
        // $term = $request->q;
        $fullNameDirectories = Storage::disk('public')->directories($path);
            $i=1;
            foreach ($fullNameDirectories as $fullNameDirectorie) {
                // if(strpos($fullNameDirectorie, $term)){
                    $directory['id']=$i;
                    $directory['text']=basename($fullNameDirectorie);

                    $directories[] =$directory;
                    $i++;
                // }
            }
            // $result['results']=$directories;
            $result=$directories;
            // $result['name']=$request->isPostType;
        return response()->json($result);
    }

}
