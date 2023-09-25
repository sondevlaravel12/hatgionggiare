<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pcategory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag){
        // $categories = Category::latest()->limit(3)->get();
        $posts = $tag->posts->toQuery()->paginate(12);
        return view('frontend.tag.detail',compact('tag','posts'));
    }
    public function postsByTag(Tag $tag){
        // $categories = Category::latest()->limit(3)->get();
        $posts = $tag->posts->toQuery()->paginate(12);
        $parentCategories = Pcategory::where('parent_id',0)->get();
        $populerPosts = Post::populer();
        $recentPosts = Post::latest()->limit(2)->get();
        // $productTags = Tag::has('posts')->with('posts')->take(5)->get();
        $postTags = Tag::has('posts')->with('posts')->take(5)->get();
        return view('frontend.tag.posts_by_tag', compact(['tag','posts','parentCategories','populerPosts','recentPosts','postTags']));
        // return view('frontend.tag.posts_by_tag',compact('tag','posts'));
    }
    // public function productsByTag(Tag $tag){
    //     // $categories = Category::latest()->limit(3)->get();
    //     $posts = $tag->posts->toQuery()->paginate(12);
    //     // $parentCategories = Pcategory::where('parent_id',0)->get();
    //     // $populerPosts = Post::populer();
    //     // $recentPosts = Post::latest()->limit(2)->get();
    //     // $productTags = Tag::has('posts')->with('posts')->take(5)->get();
    //     $productTags = Tag::has('posts')->with('posts')->take(5)->get();
    //     return view('frontend.tag.posts_by_tag', compact(['tag','posts','parentCategories','populerPosts','recentPosts','postTags']));
    //     // return view('frontend.tag.posts_by_tag',compact('tag','posts'));
    // }
}
