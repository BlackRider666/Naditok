<?php

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

Route::name('admin.')->middleware('auth')->group(function (){
    Route::resource('users','Admin\UsersController');
    Route::resource('categories','Admin\CategoryController');
    Route::resource('brands','Admin\BrandController');
    Route::resource('discounts','Admin\DiscountController');
    Route::resource('product-groups','Admin\ProductGroupController');
    Route::get('products/{product_group_id}/create','Admin\ProductController@create')->name('products.create');
    Route::post('products','Admin\ProductController@store')->name('products.store');
    Route::get('products/{product_id}','Admin\ProductController@show')->name('products.show');
    Route::get('products/{product_id}/edit','Admin\ProductController@edit')->name('products.edit');
    Route::put('products/{product_id}','Admin\ProductController@update')->name('products.update');
    Route::delete('products/{product_id}','Admin\ProductController@destroy')->name('products.destroy');
    Route::resource('comments','Admin\ProductGroupCommentController');
    Route::get('product-sizes/{product_id}/create','Admin\ProductSizeController@create')->name('product-sizes.create');
    Route::post('product-sizes','Admin\ProductSizeController@store')->name('product-sizes.store');
    Route::get('product-sizes/{size_id}','Admin\ProductSizeController@show')->name('product-sizes.show');
    Route::get('product-sizes/{size_id}/edit','Admin\ProductSizeController@edit')->name('product-sizes.edit');
    Route::put('product-sizes/{size_id}','Admin\ProductSizeController@update')->name('product-sizes.update');
    Route::delete('product-sizes/{size_id}','Admin\ProductSizeController@destroy')->name('product-sizes.destroy');
    Route::get('product-photos/{product_id}','Admin\ProductPhotoController@create')->name('product-images.create');
    Route::post('product-photos','Admin\ProductPhotoController@store')->name('product-images.store');
    Route::delete('product-photos/{photo_id}','Admin\ProductPhotoController@destroy')->name('product-images.destroy');
    Route::get('/','Admin\PagesController@index')->name('index');
});
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
