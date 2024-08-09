<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Webinfo;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('home'), ['image' => asset(Webinfo::first()->logo)]);
});
// about
Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Giới thiệu', route('about'));
});
// contact
Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Liên hệ', route('contact'));
});
// contact-> send message
Breadcrumbs::for('contact.sentmessage', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Gửi tin nhắn', route('contact.sentmessage'));
});

// return policy
Breadcrumbs::for('returnPolicy', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Chính sách đổi trả hàng', route('returnPolicy'));
});
// purchasing policy
Breadcrumbs::for('purchasingPolicy', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Chính sách mua hàng', route('purchasingPolicy'));
});

// bank infor
Breadcrumbs::for('bankinfor', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Thông tin chuyển khoản', route('bankinfor.show'));
});

// Home >  Sản Phẩm
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Sản Phẩm', route('products.index'));
});
// Home >  Sản phẩm > tên danh mục> all san pham
Breadcrumbs::for('products.category.index', function (BreadcrumbTrail $trail, Category $category) {
    if ($category->parent) {
        $trail->parent('products.category.show', $category->parent);
    } else {
        $trail->parent('products.index');
    }
    $trail->push($category->name, route('products.category.index', $category->slug), ['image' => $category->getFirstImageUrl()]);
});

// Home >  Sản phẩm > tên danh mục > tên sản phẩm
Breadcrumbs::for('products.category.show', function (BreadcrumbTrail $trail,Category $category, Product $product) {
    $trail->parent('products.category.index',$category);
    // $category = $product->category;
    $trail->push($product->name, route('products.category.show', [$category, $product]));
});

// Home >  Sản phẩm > tên sản phẩm: for product not have category yet
Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('products.index');
    // $category = $product->category;
    $trail->push($product->name, route('products.show', [ $product]));
});

// Home > Bài viết
Breadcrumbs::for('posts.index', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push('Bài viết', route('posts.index'));

});

// Breadcrumbs for Route with Category and Post
Breadcrumbs::for('posts.withCategory.show', function (BreadcrumbTrail $trail, $categories, $post) {
    $trail->parent('posts.index');

    // Break categories into an array
    $categorySlugs = explode('/', $categories);

    // Iterate over categories to create breadcrumb links
    foreach ($categorySlugs as $index => $slug) {
        $category = App\Models\Pcategory::where('slug', $slug)->first();

        // Create a breadcrumb for each category
        if ($category) {
            if ($index == count($categorySlugs) - 1) {
                // Last category does not link
                $trail->push(ucfirst($category->slug), route('pcategories.show', $categories));
            } else {
                $trail->push(ucfirst($category->slug), route('pcategories.show', $slug));
            }
        }
    }

    // Finally, push the post as the last breadcrumb without link
    $trail->push(ucfirst($post->title));
});

// Breadcrumb for viewing posts under a specific category
Breadcrumbs::for('pcategories.show', function (BreadcrumbTrail $trail, $categories) {
    $trail->parent('posts.index');

    // Check if categories are provided
    if (!empty($categories)) {
        // Split the categories string into an array
        $categorySlugs = explode('/', $categories);

        // Initialize the path to create breadcrumbs
        $path = '';

        foreach ($categorySlugs as $index => $slug) {
            $path .= $slug . '/';
            // Add each category breadcrumb except the last one
            if ($index < count($categorySlugs) - 1) {
                $trail->push(ucfirst($slug), route('pcategories.show', ['categories' => rtrim($path, '/')]));
            }
        }
         // Add the final category breadcrumb without a link
        $trail->push(ucfirst(end($categorySlugs)));
    }
});


// Home >  Bài Viết > tên danh mục> all bài viết
// Breadcrumbs::for('posts.category.index', function (BreadcrumbTrail $trail, Category $category) {
//     if ($category->parent) {
//         $trail->parent('products.category.show', $category->parent);
//     } else {
//         $trail->parent('products.index');
//     }
//     $trail->push($category->name, route('products.category.index', $category->slug), ['image' => $category->getFirstImageUrl()]);
// });
// Home > Bài viết > tên danh mục > tên bài viet
// Breadcrumbs::for('posts.pcategory.show', function (BreadcrumbTrail $trail, $category, $post) {
//     $trail->parent('home');
//     // Fetch ancestors and reverse them
//     $categories = $category->ancestors()->reverse();

//     foreach ($categories as $ancestor) {
//         $trail->push($ancestor->name, route('posts.pcategory.show', [$ancestor, $post]));
//     }

//     $trail->push($category->name, route('posts.pcategory.show', [$category, $post]));
//     // $trail->push($post, route('posts.show', [$category, $post]));
// });
// Breadcrumb for showing a post with optional categories
// Post without Category
Breadcrumbs::for('posts.withoutCategory.show', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts.index');

    // Add the post
    $trail->push($post->title, route('posts.withoutCategory.show', $post->slug));
});
// Home > Bài viết > tên bài
// Breadcrumbs::for('posts.show', function (BreadcrumbTrail $trail, $post) {
//     $trail->parent('posts.index');
//     $trail->push($post->title, route('posts.show', $post));
// });

// Home >  Bài viết > tên Tag
Breadcrumbs::for('postsByTag', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('posts');
    $trail->push($tag->name, route('tags.posts.show',$tag));
});
// Home >  Bài viết > tên Category
Breadcrumbs::for('postsByCat', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('posts.index');
    $trail->push($category->name, route('posts.category.group',$category));
});

// Home > cart
Breadcrumbs::for('cart', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push('Giỏ hàng', route('cart.index'));

});
// cart > checkout
Breadcrumbs::for('checkout', function (BreadcrumbTrail $trail){
    $trail->parent('cart');
    $trail->push('Thanh toán đơn hàng', route('cart.checkout'));

});
// cart > thankyou => since there can go backwalk so we need different parent
Breadcrumbs::for('thankyou', function (BreadcrumbTrail $trail, $order){
    $trail->parent('products');
    $trail->push('Đặt hàng thành công', route('order.thankyou',$order));

});
// Home > tên Tag > Bài viết
// Breadcrumbs::for('posts.show', function (BreadcrumbTrail $trail, $post) {
//     $trail->parent('posts');
//     $trail->push($post->title, route('tags.posts.show', $tag));
// });




// // Home >  tin tuc
// Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Tin tuc', route('post'));
// });
// // Home >  tin tuc > tin tuc chi tiet
// Breadcrumbs::for('post.detail', function (BreadcrumbTrail $trail, $post) {
//     $trail->parent('posts');
//     $trail->push($post->slug, route('post.detail',$post));
// });




// // Home >  gioi thieu
// Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Gioi thieu', route('about'));
// });

// // Home >  lien he
// Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Lien he', route('contact'));
// });

// // Home > danh muc san pham
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Danh muc san pham', route('category'));
// });
// // Home > danh muc san pham > chi tiet
// Breadcrumbs::for('category.detail', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('category');
//     $trail->push($category->slug, route('category', $category));
// });
