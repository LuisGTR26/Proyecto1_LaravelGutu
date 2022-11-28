<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



//Pagina home
Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
//Pagina acerca de 
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
//Lista de todos los productos
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name("product.index");
//Vista detalle de producto
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");
//Vista carrito
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete");
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add");
Route::middleware('auth')->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name("myaccount.orders");
});

Route::middleware('admin')->group(function () {
    //Panel home de admin
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    //Panel de lista de productos
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    //Crear productos
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    //Eliminar producto
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");
    //Editar producto
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
});

Auth::routes();