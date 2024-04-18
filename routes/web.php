<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController as BackendAboutController;
use App\Http\Controllers\Backend\CategoryController as BackendCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\InterfaceCustomizeController;
use App\Http\Controllers\Backend\OproductController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\PostController as BackendPostController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\Backend\TagController as BackendTagController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\IndexController as FrontendIndexController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\TagController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OtherInforController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampleController;
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
/// middleware name = name in Kernel.php file
// goadminlogin middleware: if already login then redirect to dashboard else do the login process by AdminController
// load login page
Route::get('admin/login',[AdminController::class,'index'])->name('login-form')->middleware('goadminlogin');
Route::post('/login/owner',[AdminController::class,'login'])->name('admin.login');



Route::prefix('admin')->middleware('adminmiddleware')->group(function(){

    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('/register',[AdminController::class,'register'])->name('admin.register');
    Route::post('/store',[AdminController::class,'store'])->name('admin.register_store');

    // customize website interface
    Route::get('/interface_customize/category',[InterfaceCustomizeController::class,'categoryDisplay'])->name('interfacecustomize.category');
    Route::get('/interface_customize/category/ajax_changed_infor_tab',[InterfaceCustomizeController::class,'ajaxChangedInforTab'])->name('interfacecustomize.ChangedInforTab');
    Route::get('/interface_customize/category/ajax_changed_sidebar_widget',[InterfaceCustomizeController::class,'ajaxChangedSidebarWidget'])->name('interfacecustomize.ChangedInSidebarWidget');


    // about
    Route::get('/about/edit',[BackendAboutController::class,'edit'])->name('admin.about.edit');
    Route::put('/about/{about}/update',[BackendAboutController::class,'update'])->name('admin.about.update');
    // contact
    Route::get('/contact/edit',[ContactController::class,'edit'])->name('admin.contact.edit');
    Route::put('/contact/{contact}/update',[ContactController::class,'update'])->name('admin.contact.update');
    // return policy
    Route::get('/return-policy/edit',[PolicyController::class,'editReturnPolicy'])->name('admin.returnPolicy.edit');
    Route::put('/return-policy/{returnPolicy}/update',[PolicyController::class,'updateReturnPolicy'])->name('admin.returnPolicy.update');
    // purchasing policy
    Route::get('/purchasing-policy/edit',[PolicyController::class,'editPurchasingPolicy'])->name('admin.purchasingPolicy.edit');
    Route::put('/purchasing-policy/{purchasingPolicy}/update',[PolicyController::class,'updatePurchasingPolicy'])->name('admin.purchasingPolicy.update');
    // purchasing policy
    Route::get('/purchasing-policy/edit',[PolicyController::class,'editPurchasingPolicy'])->name('admin.purchasingPolicy.edit');
    Route::put('/purchasing-policy/{purchasingPolicy}/update',[PolicyController::class,'updatePurchasingPolicy'])->name('admin.purchasingPolicy.update');
    // bank account information
    Route::get('/bank-infor/edit',[OtherInforController::class,'editBankInfor'])->name('admin.bankInfor.edit');
    Route::put('/bank-infor/{otherInformation}/update',[OtherInforController::class,'updateBankInfor'])->name('admin.bankInfor.update');

    Route::controller(BackendOrderController::class)->group(function () {
        Route::get('/order/fromcarts', 'index')->name('admin.order.fromcarts.index');
        Route::get('/order-fromcarts/{order}', 'show')->name('admin.order.fromcarts.detail');
        Route::get('/order/fromcarts/{order}/edit', 'edit')->name('admin.order.fromcarts.edit');
        Route::post('/order/fromcarts/{order}/update', 'update')->name('admin.order.fromcarts.update');
        Route::get('/order/fromcarts/ajax-get-order-info', 'getOrderInfo')->name('admin.order.fromcarts.getOrderInfo');


    });
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
     // tag
     Route::controller(BackendTagController::class)->group(function(){
        Route::get('/tags','index')->name('admin.tags.index');

        // Route::get('/products/create','create')->name('admin.products.create');
        // Route::post('/products/store', 'store')->name('admin.products.store');
        // Route::get('/tags/{tag}/edit','edit')->name('admin.tag.edit');
        Route::post('/tags/ajax-update','ajaxUpdate')->name('admin.tag.ajax-update');
        Route::delete('/tags/ajax-destroy', 'ajaxDestroy')->name('admin.tag.ajax-destroy');
        Route::get('/tags/tag-to-product','tagToProduct')->name('admin.tags.tag-to-product');
        Route::get('/tags/tag-to-post','tagToPost')->name('admin.tags.tag-to-post');

        Route::get('tags/search/{term}', 'tagSearch')->name('admin.tags.search');
        // add tag to product
        Route::get('tags/add-to-product', 'ajaxAddToProduct')->name('admin.tags.addToProduct');
        Route::get('tags/detach-to-product', 'ajaxDetachToProduct')->name('admin.tags.detachToProduct');
        // add tag to post
        Route::get('tags/add-to-post', 'ajaxAddToPost')->name('admin.tags.addToPost');
        Route::get('tags/detach-to-post', 'ajaxDetachToPost')->name('admin.tags.detachToPost');
        // get tag infor to fill in modal in edit list tag page
        Route::get('tags/ajax-get-tag-info', 'ajaxGetTagInfo')->name('admin.tags.ajaxGetTagInfo');
        Route::get('tags/ajax-update-tag-info', 'ajaxUpdateTagInfo')->name('admin.tags.ajaxUpdateTagInfo');
        Route::get('tags/ajax-remove-tag', 'ajaxRemoveTag')->name('admin.tags.ajaxRemoveTag');
        Route::get('tags/ajax-addnew-tag', 'ajaxAddNewTag')->name('admin.tags.ajaxAddNewTag');






    });


    // Post
    // Route::controller(BackendPostController::class)->group(function(){
        Route::get('/posts',[BackendPostController::class,'index'])->name('admin.posts.index');
        Route::get('/posts/create',[BackendPostController::class,'create'])->name('admin.posts.create');
        Route::post('/posts/store', [BackendPostController::class,'store'])->name('admin.posts.store');
        Route::get('/posts/{post}/edit',[BackendPostController::class,'edit'])->name('admin.posts.edit');
        Route::delete('/posts/ajax-delete', [BackendPostController::class,'ajaxDelete']);
        Route::put('/posts/{post}/update',[BackendPostController::class,'update'])->name('admin.posts.update');
        Route::post('/posts/ajax-setpublished',[BackendPostController::class,'ajaxSetPublished'])->name('admin.posts.published');

    // });

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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


/* --------------------- End Backend route  --------------------------- */

/* --------------------- User route  --------------------------- */
Route::get('/', [FrontendIndexController::class,'index'])->name('home');
Route::get('gioi-thieu/', [AboutController::class,'index'])->name('about');
Route::get('lien-he/', [ContactController::class,'index'])->name('contact');
Route::post('lien-he/gui-tin-nhan', [ContactController::class,'sentMessage'])->name('contact.sentmessage');
Route::get('chinh-sach-doi-tra/', [PolicyController::class,'showReturnPolicy'])->name('returnPolicy');
Route::get('chinh-sach-mua-hang/', [PolicyController::class,'showPurchasingPolicy'])->name('purchasingPolicy');

// payment information
Route::get('thong-tin-chuyen-khoan', [FrontendIndexController::class,'showBankInfor'])->name('bankinfor.show');



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
Route::get('gio-hang', [UserCartController::class, 'index'])->name('cart.index');

// checkout process
Route::get('thanh-toan-don-hang', [UserCartController::class, 'checkout'])->name('cart.checkout');
Route::post('hoan-thanh-don-hang', [OrderController::class,'store'])->name('order.store');
Route::get('don-hang-da-hoan-thanh/{order}', [OrderController::class, 'thankyou'])->name('order.thankyou');




Route::get('user/gio-hang/hien-thi-san-pham', [UserCartController::class,'indexAjaxShowCartItem'])->name('cart.index.indexAjaxShowCartItem');

Route::get('user/gio-hang/san-pham/xoa/{itemId}', [UserCartController::class,'removeCartItem'])->name('cart.item.remove');

Route::get('user/gio-hang/san-pham/tang/{itemId}', [UserCartController::class,'increaseQuantity'])->name('cart.item.increase');
Route::get('user/gio-hang/san-pham/giam/{itemId}', [UserCartController::class,'decreaseQuantity'])->name('cart.item.increase');

Route::get('user/gio-hang/san-pham/tinh-tong', [UserCartController::class,'calculateTotal'])->name('cart.calculateTotal');

Route::post('user/gio-hang/them-coupon', [UserCartController::class,'addCoupon'])->name('cart.addCoupon');
Route::get('user/coupon/xoa', [UserCartController::class,'removeCoupon'])->name('cart.removeCoupon');


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

/* --------------------- User Auth and Profile  --------------------------- */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
/* --------------------- End User and Profile   --------------------------- */

/* --------------------- Admin Profile  --------------------------- */
    Route::middleware('adminmiddleware')->group((function(){
        Route::get('/admin/profile', [AdminController::class,'profile'])->name('admin.profile.index');
    }));
/* --------------------- End Admin Profile  --------------------------- */

/* --------------------- Super Admin --------------------------- */
Route::middleware('adminmiddleware')->group((function(){
    Route::get('/superadmin/sample/index', [SampleController::class,'index'])->name('superadmin.sample.index');
    Route::get('/superadmin/sample/create', [SampleController::class,'create'])->name('superadmin.sample.create');
    Route::post('/superadmin/sample/store', [SampleController::class,'store'])->name('superadmin.sample.store');


    Route::get('/superadmin/ajax-get-sample-info', [SampleController::class,'ajaxGetSampleInfo'])->name('superadmin.ajaxGetSampleInfo');
    Route::post('/superadmin/ajax-update-sample-info', [SampleController::class,'ajaxUpdateSampleInfo'])->name('superadmin.ajaxUpdateSampleInfo');
    Route::get('/superadmin/ajax-remove-sample', [SampleController::class,'ajaxRemoveSample'])->name('superadmin.ajaxRemoveSample');

    Route::get('/superadmin/original-product/index', [OproductController::class,'index'])->name('superadmin.originalproduct.index');
    Route::get('/superadmin/oproduct/ajax-get-oproduct-info', [OproductController::class,'ajaxGetOproductInfo'])->name('superadmin.oproduct.ajaxGetOproductInfo');
    Route::get('/supperadmin/oproduct/ajax-update-oproduct-info', [OproductController::class,'ajaxUpdateOproductInfo'])->name('superadmin.oproduct.ajaxUpdateOproductInfo');
    Route::get('/supperadmin/oproduct/ajax-remove-oproduct', [OproductController::class,'ajaxRemoveOproduct'])->name('superadmin.oproduct.ajaxRemoveOproduct');
    Route::get('/asuperdmin/oproduct/ajax-addnew-oproduct', [OproductController::class,'ajaxAddnewOproduct'])->name('superadmin.oproduct.ajaxAddnewOproduct');

    Route::get('/superadmin/oproduct/search/{term}', [OproductController::class,'search'])->name('superadmin.oproduct.search');
    Route::get('/superadmin/oproduct/select2-search', [OproductController::class,'select2SearchByName'])->name('superadmin.oproduct.select2Search');



    Route::get('/superadmin/oproduct/ajax-search-relative-samples', [OproductController::class,'ajaxSearchRelativeSamples'])->name('superadmin.oproduct.ajaxSearchRelativeSamples');
    Route::get('/superadmin/oproduct/ajax-search-by-name', [OproductController::class,'ajaxSearchByName'])->name('superadmin.oproduct.ajaxSearchByName');

    Route::get('/superadmin/oproduct/import', [OproductController::class,'importFromScv'])->name('superadmin.oproduct.import');





}));
/* --------------------- End Super Admin --------------------------- */



