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

// Home >  Danh mục sản phẩm
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Sản phẩm', route('home'));
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
