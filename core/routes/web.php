<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

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


Route::get('/', [HomeController::class, 'home']);

// Route::middleware(['auth'])->group(function () {
//     Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//     Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
//     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// });


Route::middleware(['auth'])->group(function () {
    // Cart routes
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    // Order routes
    // Route::post('/checkout/all', [OrderController::class, 'checkoutAll'])->name('checkout.all');
    Route::post('/checkout/{id}', [OrderController::class, 'checkoutItem'])->name('checkout');
    
    // Orders history
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/order/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel');

});



Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    // Route::post('/products', [ProductController::class, 'store'])->name('products.store');
});


// Route::get('/admin/products/create', [ProductController::class, 'create']);
// Route::post('admin/products/create', [ProductController::class, 'store'])->name('products.store');
// // Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
// // Route::get('admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// // Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('products.update');
// // Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


// Route::prefix('admin/products')->name('admin.products.')->group(function () {
//     Route::get('/create', [ProductController::class, 'create'])->name('create');
//     Route::post('/', [ProductController::class, 'store'])->name('store');
// });

Route::get('admin/products/create', [ProductController::class, 'create'])->name('create');
Route::post('admin/products/create', [ProductController::class, 'store'])->name('store');
Route::post('admin/products/create', [ProductController::class, 'store'])->name('store');
Route::get('admin/products', [ProductController::class, 'index'])->name('index');


Route::get('prodcuts/{category_id}', [ProductController::class, 'filter'])->name('filter');


Route::get('/admin/prodcuts/edit/{product}', [ProductController::class, 'edit'])->name('edit');
Route::post('/admin/prodcuts/update/{product}', [ProductController::class, 'update'])->name('update');


Route::post('/admin/prodcuts/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
Route::post('/admin/prodcuts/delete/{id}', [ProductController::class, 'destroy'])->name('delete');

Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');


 

Route::post('admin/categories/create', [CategoryController::class, 'store'])->name('categories.store');
Route::get('admin/categories/create', [CategoryController::class, 'create']);



Route::get('admin/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');

Route::post('admin/categories/edit/{category}', [CategoryController::class, 'update'])->name('categories.edit');

Route::post('admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');


Route::get('admin/categories', [CategoryController::class, 'index'])->name("categories.index");

 
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');




Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user', [AuthController::class, 'user']);
//     Route::post('/logout', [AuthController::class, 'logout']);
// });



Route::get('/about', function () {
    return view('about');
});


// showPaymentForm
// Route::get('/payment/   }', function () {
//     return view('payment', []);
// });

Route::get('/payment/{orderId}', [App\Http\Controllers\PaymentController::class, 'showPaymentForm']);


Route::post('/submit/{orderId}', [App\Http\Controllers\PaymentController::class, 'submit'])->name('submit');