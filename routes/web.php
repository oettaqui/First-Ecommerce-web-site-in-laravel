<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class,'index']);
// Route::get('/Allcategories',[App\Http\Controllers\Frontend\FrontendController::class,'categories']);
Route::get('/collections/{category_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'products']);
Route::get('/collections/{category_slug}/{product_slug}',[App\Http\Controllers\Frontend\FrontendController::class,'productView']);
Route::get('search',[App\Http\Controllers\Frontend\FrontendController::class,'searchProducts']);

Route::middleware('auth')->group(function (){
    Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class,'index']); 
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class,'index']); 
    Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class,'index']); 
    Route::get('orders',[App\Http\Controllers\Frontend\OrderController::class,'index']); 
    Route::get('orders/{orderId}',[App\Http\Controllers\Frontend\OrderController::class,'show']); 
    Route::get('profile',[App\Http\Controllers\Frontend\UserController::class,'index']); 
    Route::post('profile',[App\Http\Controllers\Frontend\UserController::class,'updateUserDetails']); 
    Route::get('change-password',[App\Http\Controllers\Frontend\UserController::class,'passwordCreate']); 
    Route::post('change-password',[App\Http\Controllers\Frontend\UserController::class,'changePassword']);

});

Route::get('/thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index']);
    //category
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::get('category/trashed', [App\Http\Controllers\Admin\CategoryController::class,'trashedCategory'])->name('admin.categories.trash'); 
    Route::get('category/back/{id}',[App\Http\Controllers\Admin\CategoryController::class,'backfromtrash'])->name('admin.categories.back');
    Route::get('category/forceDelete/{id}',[App\Http\Controllers\Admin\CategoryController::class,'forceDelete'])->name('admin.categories.forceDelete');
    // products
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::get('product-image/{id}/delete',[App\Http\Controllers\Admin\ProductController::class,'destroyImage'])->name('admin.products.destroyImage');
    Route::get('product/trashed', [App\Http\Controllers\Admin\ProductController::class,'trashedProduct'])->name('admin.products.trash'); 
    Route::get('product/back/{id}',[App\Http\Controllers\Admin\ProductController::class,'backfromtrashed'])->name('admin.products.back');
    Route::get('product/forceDelete/{id}',[App\Http\Controllers\Admin\ProductController::class,'forceDelete'])->name('admin.products.forceDelete');
    //slider
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
    Route::get('slider/trashed', [App\Http\Controllers\Admin\SliderController::class,'trashedSlider'])->name('admin.sliders.trash');  
    Route::get('slider/back/{id}',[App\Http\Controllers\Admin\SliderController::class,'backfromtrash'])->name('admin.sliders.back');
    // orders
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function (){

        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
    });
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function (){
        Route::get('/users', 'index');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users', 'store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('users/{id}', 'update');
        Route::get('/users/{id}/delete', 'destroy')->name('users.destroy');
    });
});
