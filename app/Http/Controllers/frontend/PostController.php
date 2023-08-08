<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        //$product = Product::findOrFail($id);
        $posts = Post::latest()->paginate(3);
        return view('frontend.post.index', compact('posts','posts'));
    }
    public function show(Post $post){
        return view('frontend.post.detail', compact('post','post'));
    }
}
