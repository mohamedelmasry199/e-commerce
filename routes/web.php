<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/category/aboutUs',[CategoryController::class, 'aboutUS'])->name('aboutUs');
Route::get('/home',[CategoryController::class , 'index'])->name('home');
Route::get('/category/{category}', [CategoryController::class , 'showProducts'])->name('category.products');
Route::get('/profile/index/{id}',[ProfileController::class,'index'])->name('profile');

Route::get('/products/create',[\App\Http\Controllers\Auth\AdminController::class , 'createProduct'])->name('product.create');
Route::post('products/store',[\App\Http\Controllers\Auth\AdminController::class,'storeProduct'])->name('product.store');
Route::get('/products/update/{id}',[\App\Http\Controllers\Auth\AdminController::class , 'updateProduct'])->name('product.update');
Route::put('/products/edit/{id}',[\App\Http\Controllers\Auth\AdminController::class,'editProduct'])->name('product.edit');
Route::delete('/product/delete/{id}',[\App\Http\Controllers\Auth\AdminController::class,'destroyProduct'])->name('product.delete');
Route::get('/products/show/{id}',[ProductController::class,'show'])->name('product.show');
Route::get('/products/search', [ProductController::class,'search'])->name('products.search');
Route::get('/edit',[\App\Http\Controllers\Auth\AdminController::class,'editPage'])->name('edit');
Route::get('/categories/create',[\App\Http\Controllers\Auth\AdminController::class , 'createCategory'])->name('category.create');
Route::post('categories/store',[\App\Http\Controllers\Auth\AdminController::class,'storeCategory'])->name('category.store');
Route::get('/categories/update/{id}',[\App\Http\Controllers\Auth\AdminController::class , 'updateCategory'])->name('category.update');
Route::put('/categories/edit/{id}',[\App\Http\Controllers\Auth\AdminController::class,'editCategory'])->name('category.edit');
Route::delete('/categories/delete/{id}',[\App\Http\Controllers\Auth\AdminController::class,'destroyCategory'])->name('category.delete');

Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');
// // Route::post('/add-to-cart', [CartController::class,'addToCart'])->name('cart.add');
Route::post('/place-order', [OrderController::class,'placeOrder'])->name('order.place');
Route::post('category/product/buy/{id}',[ProductController::class,'buy'])->name('product.buy');
// // Route::get('/checkout', [CartController::class,'showCheckout'])->name('checkout');
// Route::get('/', [CartController::class, 'index']);
// Route::get('cart', [CartController::class, 'cart'])->name('cart');
// Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
// Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
// Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');


// Route::get('/order/create', [OrderController::class,'create'])->name('order.create');
// Route::post('/order/store', [OrderController::class,'store'])->name('order.store');
// Route::get('/order/{id}', [OrderController::class,'show'])->name('order.show');
// Route::get('/orders', [OrderController::class,'index'])->name('order.index');
// Route::put('/order/{id}', [OrderController::class,'update'])->name('order.update');
// Route::delete('/order/{id}', [OrderController::class,'destroy'])->name('order.destroy');



