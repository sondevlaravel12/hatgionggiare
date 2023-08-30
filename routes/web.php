<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController as BackendAboutController;
use App\Http\Controllers\Backend\CategoryController as BackendCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\backend\PostController as BackendPostController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\IndexController as FrontendIndexController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\TagController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* --------------------- Admin route  --------------------------- */
Route::prefix('admin')->group(function(){

    Route::get('/login',[AdminController::class,'index'])->name('login-form');
    Route::post('/login/owner',[AdminController::class,'login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout')->middleware('admin');
    Route::get('/register',[AdminController::class,'register'])->name('admin.register');
    Route::post('/store',[AdminController::class,'store'])->name('admin.register_store');

    // about
    Route::get('/about/edit',[BackendAboutController::class,'edit'])->name('admin.about.edit');
    Route::put('/about/{about}/update',[BackendAboutController::class,'update'])->name('admin.about.update');
    // contact
    Route::get('/contact/edit',[ContactController::class,'edit'])->name('admin.contact.edit');
    Route::put('/contact/{contact}/update',[ContactController::class,'update'])->name('admin.contact.update');


    // coupon
    Route::get('/coupons',[CouponController::class,'index'])->name('admin.coupons.index');
    Route::get('/coupons/create',[CouponController::class,'create'])->name('admin.coupons.create');
    Route::post('/coupons/store',[CouponController::class,'store'])->name('admin.coupons.store');
    Route::get('/coupons/{coupon}/edit',[CouponController::class,'edit'])->name('admin.coupons.edit');
    Route::put('/coupons/{coupon}/update',[CouponController::class,'update'])->name('admin.coupons.update');

    Route::delete('/coupons/{coupon}/delete',[CouponController::class,'destroy'])->name('admin.coupons.destroy');

    // product
    Route::controller(BackendProductController::class)->group(function(){
        Route::get('/products','index')->name('admin.products.index');
        Route::get('/products/create','create')->name('admin.products.create');
        Route::post('/products/store', 'store')->name('admin.products.store');
        Route::get('/products/{product}/edit',[BackendProductController::class,'edit'])->name('admin.products.edit');
        Route::delete('/products/ajax-delete', [BackendProductController::class,'ajaxDelete']);
        Route::put('/products/{product}/update',[BackendProductController::class,'update'])->name('admin.products.update');
    });

    // Post
    Route::controller(BackendPostController::class)->group(function(){
        Route::get('/posts','index')->name('admin.posts.index');
        Route::get('/posts/create','create')->name('admin.posts.create');
        Route::post('/posts/store', 'store')->name('admin.posts.store');
        // Route::get('/products/{product}/edit',[BackendProductController::class,'edit'])->name('admin.products.edit');
        Route::delete('/posts/ajax-delete', 'ajaxDelete');
        // Route::put('/products/{product}/update',[BackendProductController::class,'update'])->name('admin.products.update');
    });

    // category
    Route::controller(BackendCategoryController::class)->group(function(){
        Route::get('/categories','index')->name('admin.categories.index');
        Route::get('/categories/create','create')->name('admin.categories.create');
        Route::post('/categories/store', 'store')->name('admin.categories.store');
        Route::delete('/categories/ajax-delete', 'ajaxDelete');
        // admin.categories.update

        // Route::delete('/categories/{category}/delete','destroy')->name('admin.categories.destroy');
        Route::get('/categories/{category}/edit','edit')->name('admin.categories.edit');
        Route::put('/categories/{category}/update','update')->name('admin.categories.update');



    });




});
/* --------------------- End Admin route  --------------------------- */


/* --------------------- Backend route  --------------------------- */

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


/* --------------------- End Backend route  --------------------------- */

/* --------------------- User route  --------------------------- */
Route::get('/', [FrontendIndexController::class,'index'])->name('home');
Route::get('gioi-thieu/', [AboutController::class,'index'])->name('about');
Route::get('lien-he/', [ContactController::class,'index'])->name('contact');
Route::post('lien-he/gui-tin-nhan', [ContactController::class,'sentMessage'])->name('contact.sentmessage');


// product controller
Route::get('san-pham/{product}/{slug?}', [ProductController::class,'show'])->name('products.show');
Route::get('san-pham/modal/show/{id}', [ProductController::class,'ajaxModalShow'])->name('products.modal.show');

// post controller
Route::get('bai-viet', [PostController::class,'index'])->name('posts.index');
Route::get('bai-viet/{post}/{slug?}', [PostController::class,'show'])->name('posts.show');
Route::get('danh-muc/{category_id}/bai-viet', [PostController::class,'group'])->name('posts.category.group');

// tag controller
Route::get('tag/{tag}/san-pham', [ProductController::class,'productsByTag'])->name('tags.products.show');
Route::get('tag/{tag}/bai-viet', [TagController::class,'postsByTag'])->name('tags.posts.show');






// cart controller
Route::post('gio-hang/them-vao-gio-hang', [CartController::class,'ajaxAddtoCart'])->name('cart.store');
Route::get('mini-gio-hang/fill-in', [CartController::class,'ajaxFillinMiniCart'])->name('minicart.fill');
Route::get('mini-gio-hang/item/remove/{rowId}', [CartController::class,'ajaxRemoveMiniCartItem'])->name('minicart.item.remove');
route::get('gio-hang', [UserCartController::class, 'index'])->name('cart.index');

// checkout process
route::get('thanh-toan-don-hang', [UserCartController::class, 'checkout'])->name('cart.checkout');
Route::post('hoan-thanh-don-hang', [OrderController::class,'store'])->name('order.store');
route::get('Don-hang-da-hoan-thanh/{order}', [OrderController::class, 'thankyou'])->name('order.thankyou');




Route::get('user/gio-hang/hien-thi-san-pham', [UserCartController::class,'indexAjaxShowCartItem'])->name('cart.index.indexAjaxShowCartItem');

Route::get('user/gio-hang/san-pham/xoa/{itemId}', [UserCartController::class,'removeCartItem'])->name('cart.item.remove');

Route::get('user/gio-hang/san-pham/tang/{itemId}', [UserCartController::class,'increaseQuantity'])->name('cart.item.increase');
Route::get('user/gio-hang/san-pham/giam/{itemId}', [UserCartController::class,'decreaseQuantity'])->name('cart.item.increase');

Route::get('user/gio-hang/san-pham/tinh-tong', [UserCartController::class,'calculateTotal'])->name('cart.calculateTotal');

Route::post('user/gio-hang/them-coupon', [UserCartController::class,'addCoupon'])->name('cart.addCoupon');


// wishlist controller
route::group(['prefix'=>'user'], function(){
    Route::get('yeu-thich/san-pham/them/{productId}', [WishlistController::class,'ajaxAddToWishlist'])->name('wishlist.item.add');
    Route::get('ds-yeu-thich', [WishlistController::class,'index'])->name('wishlist.index');
    Route::get('ds-yeu-thich/hien-thi-san-pham', [WishlistController::class,'indexAjaxShowWishlishItem'])->name('wishlist.index.ajaxShowWishlistItem');
    Route::get('/ds-yeu-thich/san-pham/xoa/{itemId}', [WishlistController::class,'removeWishlistItem'])->name('wishlist.item.remove');
    Route::get('/ds-yeu-thich/chuyen-vao-gio-hang/{itemId}', [WishlistController::class,'moveToCart'])->name('wishlist.item.moveToCart');
});


// Route::get('ds-yeu-thich/', [WishlistController::class,'index'])->name('wishlist.index');


// Route::get('bai-viet/{post}/{slug?}', [PostController::class,'show'])->name('post.show');

Route::get('danh-muc/tat-ca/san-pham', [CategoryController::class,'index'])->name('categories.products.index');
Route::get('danh-muc/{category}/san-pham', [CategoryController::class,'show'])->name('categories.products.show');



/* --------------------- End User route  --------------------------- */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
