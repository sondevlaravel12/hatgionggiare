<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pcategory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        //$product = Product::findOrFail($id);
        $posts = Post::latest()->paginate(3);
        $parentCategories = Pcategory::where('parent_id',0)->get();
        $populerPosts = Post::populer();
        $recentPosts = Post::latest()->limit(2)->get();
        // $productTags = Tag::has('posts')->with('posts')->take(5)->get();
        $postTags = Tag::has('posts')->with('posts')->take(5)->get();
        return view('frontend.post.index', compact(['posts','parentCategories','populerPosts','recentPosts','postTags']));
    }
    public function show(Post $post){
        return view('frontend.post.detail', compact(['post']));
    }
    // like show function in CategoryController, in this cate i do not create PcategoryController so that i write the function here and name it like that, does it make sense
    public function group (Request $request){
        if($request->category_id){
            $category = Pcategory::find($request->category_id) ;
            $parentCategories = Pcategory::where('parent_id',0)->get();
            $populerPosts = Post::populer();
            $recentPosts = Post::latest()->limit(2)->get();
            $postTags = Tag::has('posts')->with('posts')->take(5)->get();


            if($category->posts->count()>0){
                $posts = $category->posts->toQuery()->paginate(3);
                return view('frontend.post.post_by_cat',compact(['category','posts','parentCategories','populerPosts','recentPosts','postTags']));
                // use frontend.post.index instead of post_by_cat bz there is no diffirent between these view right now
            }

        }

    }
}
