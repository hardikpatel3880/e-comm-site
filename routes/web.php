<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSizeMasterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\visitor\VisitorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('visitor/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('visitor/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('visitor/logout', [AuthController::class, 'logout'])->name('visitor.logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

    // Permission Controller route
    Route::get('permission/index', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/edit/{id?}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('permission/update/{id?}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('permission/show/{id?}', [PermissionController::class, 'show'])->name('permission.show');
    Route::get('permission/delete/{id?}', [PermissionController::class, 'delete'])->name('permission.delete');

    // Product Controller route
    Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id?}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id?}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/delete/{id?}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/product/image/delete/{id?}', [ProductController::class, 'deleteImage'])->name('product.image.delete');

    // Product Size Master Controller route
    Route::get('productSizeMaster/index', [ProductSizeMasterController::class, 'index'])->name('productSizeMaster.index');
    Route::get('productSizeMaster/create', [ProductSizeMasterController::class, 'create'])->name('productSizeMaster.create');
    Route::post('productSizeMaster/store', [ProductSizeMasterController::class, 'store'])->name('productSizeMaster.store');
    Route::get('productSizeMaster/edit/{id?}', [ProductSizeMasterController::class, 'edit'])->name('productSizeMaster.edit');
    Route::post('productSizeMaster/update/{id?}', [ProductSizeMasterController::class, 'update'])->name('productSizeMaster.update');
    Route::get('productSizeMaster/delete/{id?}', [ProductSizeMasterController::class, 'delete'])->name('productSizeMaster.delete');

    // Slider Controller route
    Route::get('slider/index', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/edit/{id?}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/update/{id?}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('slider/delete/{id?}', [SliderController::class, 'delete'])->name('slider.delete');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});

Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
// visitor
Route::get('/', [VisitorController::class, 'home'])->name('visitor.home');
Route::get('/products', [VisitorController::class, 'product'])->name('visitor.product');

// Route::get('/products', [VisitorController::class, 'product'])->name('visitor.product');
Route::get('/product/{slug?}', [VisitorController::class, 'productDetail'])->name('visitor.productDetail');
