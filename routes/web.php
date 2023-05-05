<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
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

// Route::get('/', [ProductCategoryController::class, 'index']);

Route::get('/checkout', [HomeController::class, 'index'])->name('checkout.index');
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
});

Route::prefix('shop')->group(function () {
    Route::get('/product/{id}', [ShopController::class, 'show'])->name('productDetail.index');
    Route::post('/product/{id}', [ShopController::class, 'postComment'])->name('postComment.store');
    Route::post('/product/add/{id}', [ShopController::class, 'addShow'])->name('productDetail.addCart');
    Route::get('', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/category/{categoryName}', [ShopController::class, 'category'])->name('shop.category');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('add/{id}', [CartController::class, 'add'])->name('cart.create');
    Route::post('add/{id}', [CartController::class, 'addToCart'])->name('addToCart.create');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::delete('delete', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
});
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckOutController::class, 'addOrder'])->name('checkout.addOrder');
    Route::get('/result', [CheckOutController::class, 'result'])->name('checkout.result');
    Route::get('/vnPayCheck', [CheckOutController::class, 'vnPayCheck'])->name('checkout.vnPayCheck');
});
Route::prefix('account')->group(function () {
    Route::get('/login', [AccountController::class, 'login'])->name('login.index');
    Route::get('/logout', [AccountController::class, 'logout'])->name('logout.index');
    Route::post('/login', [AccountController::class, 'checkLogin'])->name('checkLogin.index');
    Route::get('/register', [AccountController::class, 'register'])->name('register.index');
    Route::post('/register', [AccountController::class, 'postRegister'])->name('postRegister.index');
});
Route::prefix('/admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/login', [AdminController::class, 'checkLogin'])->name('loginAdmin.index');
    Route::post('/login', [AdminController::class, 'postCheckLogin'])->name('postLoginAdmin.index');
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/add', [UserController::class, 'create'])->name('user.create');
        Route::post('/add', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/edit/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/add', [OrderController::class, 'create'])->name('order.create');
        Route::post('/add', [OrderController::class, 'store'])->name('order.store');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('/edit/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/edit/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    });
    Route::prefix('brand')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/show/{id}', [BrandController::class, 'show'])->name('brand.show');
        Route::get('/add', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/add', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/edit/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/edit/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    });
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/add', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/edit/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/add', [ProductController::class, 'create'])->name('product.create');
        Route::post('/add', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/edit/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/edit/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
});