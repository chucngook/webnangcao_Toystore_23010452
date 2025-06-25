<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Đây là nơi bạn đăng ký các web route cho ứng dụng của mình.
|
*/

// --- IMPORT CONTROLLERS ---
// Nhóm các controller theo chức năng để dễ quản lý

// Controllers cho phần công khai (Public-facing)
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Controllers cho người dùng đã đăng nhập (Authenticated User)
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController; // Controller xem đơn hàng của người dùng

// Controllers cho khu vực Quản trị (Admin)
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


//======================================================================
// 1. PUBLIC ROUTES (Ai cũng có thể truy cập)
//======================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes cho hiển thị Sản phẩm và Danh mục
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Routes cho Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update'); // Dùng PATCH cho update
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove'); // Dùng DELETE cho remove


//======================================================================
// 2. AUTHENTICATED USER ROUTES (Yêu cầu phải đăng nhập)
//======================================================================

Route::middleware('auth')->group(function () {
    
    // Route mặc định của Breeze sau khi đăng nhập
    Route::get('/dashboard', function () {
        // Có thể chuyển hướng đến trang xem đơn hàng của người dùng
        return redirect()->route('orders.index');
    })->name('dashboard');

    // Route quản lý Profile cá nhân
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route cho quá trình Thanh toán
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // Route xem lại đơn hàng của người dùng
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});


//======================================================================
// 3. ADMIN ROUTES (Yêu cầu đăng nhập VÀ là Admin)
//======================================================================

Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Trang chủ của khu vực Admin
    Route::get('/', [AdminOrderController::class, 'index'])->name('dashboard');

    // Quản lý Đơn hàng
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');

    // Quản lý Sản phẩm và Danh mục
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
});


//======================================================================
// 4. BREEZE AUTHENTICATION ROUTES (Các route Đăng nhập, Đăng ký...)
//======================================================================
require __DIR__.'/auth.php';