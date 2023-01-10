<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\frontend\IndexController as FrontendIndexController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\ProfileController;
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
Route::get('sanpham/{id}', [ProductController::class,'show'])->name('products.show');


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
