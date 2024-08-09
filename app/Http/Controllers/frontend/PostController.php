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
    public function index($categories = null){
        $this->fetchSideBar();
        $posts = Post::all();


        return view('frontend.post.index')->with([
            'posts'=>$this->posts,
            'parentCategories'=>$this->parentCategories,
            'populerPosts'=>$this->populerPosts,
            'recentPosts'=>$this->recentPosts,
            'postTags'=>$this->postTags,

        ]);
    }
    public function test(){
        dd('test');
    }
    public function postsByCategory($categories){
        // dd($categories);

        $this->fetchSideBar();

        // Chia các danh mục thành mảng
        $categorySlugs = explode('/', $categories);

        // Lấy slug của danh mục cuối cùng (danh mục hiện tại)
        $currentCategorySlug = array_pop($categorySlugs);

        // Tìm danh mục hiện tại dựa trên slug của nó
        $category = Pcategory::where('slug', $currentCategorySlug)->first();

        if (!$category) {
            abort(404); // Không tìm thấy danh mục
        }
        // Lấy tất cả bài viết thuộc danh mục hiện tại và các danh mục con của nó
        // $posts = Post::whereHas('categories', function ($query) use ($category) {
        //     $query->where('id', $category->id)
        //           ->orWhereIn('id', $category->descendants->pluck('id'));
        // })->get();
        if($category->allPosts()->count()>0){
            $posts = $category->allPosts()->toQuery()->paginate(12);
            return view('frontend.post.index')->with([
                'posts'=>$posts,
                'parentCategories'=>$this->parentCategories,
                'populerPosts'=>$this->populerPosts,
                'recentPosts'=>$this->recentPosts,
                'postTags'=>$this->postTags,
            ]);
        }else{
            // return back()->withErrors('Danh Mục Này Không Có Sản Phẩm');
            return view('frontend.category.detail')->with([
                'error'=>'Danh Mục Này Không Có Sản Phẩm',
                'category'=>$category
            ]);
        }

            // if ($baseCategory) {
            //     // Get all child categories of the base category
            //     $childCategories = $baseCategory->descendants()->pluck('id')->toArray();
            //     $childCategories[] = $baseCategory->id; // Include base category itself

            //     // Retrieve posts associated with the base category and its child categories
            //     $posts = Post::whereIn('pcategory_id', $childCategories)->get();
            // } else {
            //     // If no base category, just get all posts
            //     $posts = Post::all();
            // }

    }

    public function showWithCategory($categories, Post $post)
    {
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
    public function showWithoutCategory(Post $post){
        dd('hi');
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

    // public function postsByPcategory($category){
    //     if($category->posts->count()>0){
    //         $posts = $category->posts->toQuery()->paginate(12);
    //         return view('frontend.category.detail')->with([
    //             'products'=>$posts,
    //             'category'=>$category
    //         ]);
    //     }else{
    //         // return back()->withErrors('Danh Mục Này Không Có Sản Phẩm');
    //         return view('frontend.category.detail')->with([
    //             'error'=>'Danh Mục Này Không Có Sản Phẩm',
    //             'category'=>$category
    //         ]);
    //     }
    // }


    // like show function in CategoryController, in this cate i do not create PcategoryController so that i write the function here and name it like that, does it make sense
    public function group (Request $request, Pcategory $pcategory){
        if($pcategory){
            // $category = Pcategory::find($request->category_id) ;
            $this->fetchSideBar();
            if($pcategory->posts->count()>0){
                $posts = $pcategory->posts->toQuery()->paginate(3);
                return view('frontend.post.post_by_cat')->with([
                    'posts'=>$posts,
                    'parentCategories'=>$this->parentCategories,
                    'populerPosts'=>$this->populerPosts,
                    'recentPosts'=>$this->recentPosts,
                    'postTags'=>$this->postTags,
                    'category'=>$pcategory
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
