<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\IndexController as FrontendIndexController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\ProfileController;
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

});


/* --------------------- End Admin route  --------------------------- */

/* --------------------- User route  --------------------------- */
Route::get('/', [FrontendIndexController::class,'index'])->name('home');
// product controller
Route::get('san-pham/{product}/{slug?}', [ProductController::class,'show'])->name('products.show');
Route::get('san-pham/modal/show/{id}', [ProductController::class,'ajaxModalShow'])->name('products.modal.show');

// cart controller
Route::post('gio-hang/them-vao-gio-hang', [CartController::class,'ajaxAddtoCart'])->name('cart.store');
Route::get('mini-gio-hang/fill-in', [CartController::class,'ajaxFillinMiniCart'])->name('minicart.fill');
Route::get('mini-gio-hang/item/remove/{rowId}', [CartController::class,'ajaxRemoveMiniCartItem'])->name('minicart.item.remove');

// wishlist controller
route::group(['prefix'=>'user','middleware'=>['auth']], function(){
    Route::get('yeu-thich/san-pham/them/{productId}', [WishlistController::class,'ajaxAddToWishlist'])->name('wishlist.item.add');
    Route::get('ds-yeu-thich', [WishlistController::class,'index'])->name('wishlist.index');
    Route::get('ds-yeu-thich/hien-thi-san-pham', [WishlistController::class,'indexAjaxShowWishlishItem'])->name('wishlist.index.ajaxShowWishlistItem');
    Route::get('/ds-yeu-thich/san-pham/xoa/{itemId}', [WishlistController::class,'removeWishlistItem'])->name('wishlist.item.remove');
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
