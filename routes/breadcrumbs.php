<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('home'));
});
// about
Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Giới thiệu', route('about'));
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
// contact
Breadcrumbs::for('contact', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Liên hệ', route('contact'));
});

// Home >  Danh mục sản phẩm
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Danh Mục Sản phẩm', route('categories.products.index'));
});
// Home >  Danh mục sản phẩm > tên danh mục
Breadcrumbs::for('productCategory', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('products');
    $trail->push($category->name, route('categories.products.show', $category));
});

// Home >  Danh mục sản phẩm > Chi tiết sản phẩm

Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products');
    $trail->push($product->name, route('products.show', $product));
});

// Home > Bài viết
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push('Bài viết', route('posts.index'));

});
// Home > Bài viết > tên bài
Breadcrumbs::for('posts.show', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts');
    $trail->push($post->title, route('posts.show', $post));
});
// Home >  Bài viết > tên Tag
Breadcrumbs::for('postsByTag', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('posts');
    $trail->push($tag->name, route('tags.posts.show',$tag));
});
// Home >  Bài viết > tên Category
Breadcrumbs::for('postsByCat', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('posts');
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
