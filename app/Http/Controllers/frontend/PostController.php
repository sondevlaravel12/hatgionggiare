<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pcategory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Traits\SeoCustomize;

class PostController extends Controller
{
    use SeoCustomize;
    private $posts,$parentCategories,$populerPosts,$recentPosts,$postTags;
    private function fetchSideBar(){
        $this->posts = Post::latest()->paginate(3);
        $this->parentCategories = Pcategory::where('parent_id',0)->get();
        $this->populerPosts = Post::populer();
        $this->recentPosts = Post::latest()->limit(2)->get();
        $this->postTags = Tag::has('posts')->with('posts')->take(5)->get();
    }
    public function index(){
        $this->fetchSideBar();
        return view('frontend.post.index')->with([
            'posts'=>$this->posts,
            'parentCategories'=>$this->parentCategories,
            'populerPosts'=>$this->populerPosts,
            'recentPosts'=>$this->recentPosts,
            'postTags'=>$this->postTags,

        ]);
    }
    public function show(Post $post){
        $this->fetchSideBar();
        $this->setupSeoWithModel($post);
        return view('frontend.post.detail')->with([
            'posts'=>$this->posts,
            'parentCategories'=>$this->parentCategories,
            'populerPosts'=>$this->populerPosts,
            'recentPosts'=>$this->recentPosts,
            'postTags'=>$this->postTags,
            'post'=>$post
        ]);
    }
    // like show function in CategoryController, in this cate i do not create PcategoryController so that i write the function here and name it like that, does it make sense
    public function group (Request $request){
        if($request->category_id){
            $category = Pcategory::find($request->category_id) ;
            $this->fetchSideBar();
            if($category->posts->count()>0){
                $posts = $category->posts->toQuery()->paginate(3);
                return view('frontend.post.post_by_cat')->with([
                    'posts'=>$this->posts,
                    'parentCategories'=>$this->parentCategories,
                    'populerPosts'=>$this->populerPosts,
                    'recentPosts'=>$this->recentPosts,
                    'postTags'=>$this->postTags,
                    'category'=>$category
                ]);
            }

        }

    }
    public function ajaxSearch(Request $request){
        if( empty($request['term']) ){
            return false;
        }

        $key = $request['term'];

        $posts = Post::where('title','like','%' .$key .'%')->limit(10)->get();
        if( $posts->count()<1 ){
            exit;
        }

        foreach($posts as $post){
            $result[] =
                array(
                    'label' => $post->title,
                    'url'=>route('posts.show', $post),
                );
        }

        return response()->json($result);
    }
    public function ajaxSearchNothaveMetatag(Request $request){
        if( empty($request['term']) ){
            return false;
        }

        $key = $request['term'];

        $posts = Post::where('title','like','%' .$key .'%')->doesnthave('metatag')->limit(10)->get();
        if( $posts->count()<1 ){
            exit;
        }

        foreach($posts as $post){
            $result[] =
                array(
                    'label' => $post->title,
                    'model_id'=>$post->id,
                    'model_type'=>'App\Models\Post',

                );
        }

        return response()->json($result);
    }
}
