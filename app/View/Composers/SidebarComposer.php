<?php

namespace App\View\Composers;

// use App\Repositories\UserRepository;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
// use Spatie\Tags\Tag;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    // protected $users;
    private $parentCategories,$populerProducts, $recentProducts,$categories,$products,$hotDeals,$productTags;


    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->parentCategories = Category::where('parent_id',0)->whereNotNull('in_sidebar_widget')->has('children')->get();
        $this->populerProducts = Product::populer();
        $this->recentProducts = Product::latest()->limit(2)->get();
        $this->categories = Category::latest()->limit(3)->get();
        $this->hotDeals = Product::hotDeals();
        $this->productTags = Tag::has('products')->with('products')->take(5)->get();
        // $this->productTags = Tag::has('products')->take(5)->get();
        // $this->productTags = Tag::has('products')->take(5)->get();
        // $this->productTags = Tag::ordered()->take(5)->get();

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'categories'=>$this->categories,
            'parentCategories'=>$this->parentCategories,
            'populerProducts'=>$this->populerProducts,
            'recentProducts'=>$this->recentProducts,
            'productTags'=>$this->productTags,
            'hotDeals'=>$this->hotDeals,
        ]);
    }
}
