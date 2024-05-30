<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});





Route::get('/', 'App\Http\Controllers\ProductsController@index')->name('index');
Route::get('/products', 'App\Http\Controllers\ProductsController@show')->name('products');
Route::get('/products/{id}', 'App\Http\Controllers\ProductsController@product' )->name('products.[id]');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () { 
Route::get('/cart', 'App\Http\Controllers\CartController@show')->name('cart.show');
Route::post('/cart/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::post('/cart/remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart/clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
Route::get('/orders', 'App\Http\Controllers\OrderController@show')->name('orders.show');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@order')->name('orders.[id]');
Route::get('/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');
Route::post('/test', 'App\Http\Controllers\StripeController@test')->name('test');
});
