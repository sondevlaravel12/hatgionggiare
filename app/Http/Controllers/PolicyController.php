<?php

namespace App\Http\Controllers;

use App\Models\Pcategory;
use App\Models\Post;
use App\Models\PurchasingPolicy;
use App\Models\ReturnPolicy;
use App\Models\Tag;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    private $posts,$parentCategories,$populerPosts,$recentPosts,$postTags;
    private function fetchSideBar(){
        $this->posts = Post::latest()->paginate(3);
        $this->parentCategories = Pcategory::where('parent_id',0)->get();
        $this->populerPosts = Post::populer();
        $this->recentPosts = Post::latest()->limit(2)->get();
        $this->postTags = Tag::has('posts')->with('posts')->take(5)->get();
    }
    // using this controller for return, purchasing ... policy
    public function showReturnPolicy(){
        $this->fetchSideBar();
        $returnPolicy = ReturnPolicy::first();
        return view('frontend.policy.return_policy')->with([
            'posts'=>$this->posts,
            'parentCategories'=>$this->parentCategories,
            'populerPosts'=>$this->populerPosts,
            'recentPosts'=>$this->recentPosts,
            'postTags'=>$this->postTags,
            'returnPolicy'=>$returnPolicy
        ]);
    }
    public function showPurchasingPolicy(){
        $this->fetchSideBar();
        $purchasingPolicy = PurchasingPolicy::first();
        return view('frontend.policy.purchasing_policy')->with([
            'posts'=>$this->posts,
            'parentCategories'=>$this->parentCategories,
            'populerPosts'=>$this->populerPosts,
            'recentPosts'=>$this->recentPosts,
            'postTags'=>$this->postTags,
            'purchasingPolicy'=>$purchasingPolicy
        ]);
    }
    public function editReturnPolicy(){
        $returnPolicy = ReturnPolicy::first();
        return view('admin.policy.returning.edit', compact('returnPolicy'));

    }
    public function updateReturnPolicy(ReturnPolicy $returnPolicy, Request $request){
        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'content' => 'required|min:2|max:11955',
        ]);
        $input = $request->except(['_token','_method']);//why?
        // dd($returnPolicy);
        if($returnPolicy->update($input)){
            $notifycation = [
                'message' => 'Cập nhật chính sach trả hàng thành công',
                'alert-type' =>'success'
            ];
        }else{
            $notifycation = [
                'message' => 'Cập nhật chính sach trả hàng thất bại',
                'alert-type' =>'error'
            ];
        }
        return redirect()->route('admin.dashboard')->with($notifycation);
    }
    public function editPurchasingPolicy(){
        $purchasingPolicy = PurchasingPolicy::first();
        return view('admin.policy.purchasing.edit', compact('purchasingPolicy'));

    }
    public function updatePurchasingPolicy(PurchasingPolicy $purchasingPolicy, Request $request){
        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'content' => 'required|min:2|max:11955',
        ]);
        $input = $request->except(['_token','_method']);//why?
        // dd($returnPolicy);
        if($purchasingPolicy->update($input)){
            $notifycation = [
                'message' => 'Cập nhật chính sách mua hàng thành công',
                'alert-type' =>'success'
            ];
        }else{
            $notifycation = [
                'message' => 'Cập nhật chính sách mua hàng thất bại',
                'alert-type' =>'error'
            ];
        }
        return redirect()->route('admin.dashboard')->with($notifycation);
    }
}
