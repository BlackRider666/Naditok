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
    Route::resource('product-groups','Admin\ProductGroupController');
    Route::resource('products','Admin\ProductController');
    Route::resource('comments','Admin\ProductGroupCommentController');
    Route::get('product-sizes/{product_id}/create','Admin\ProductSizeController@create')->name('product-sizes.create');
    Route::post('product-sizes','Admin\ProductSizeController@store')->name('product-sizes.store');
    Route::get('product-sizes/{size_id}','Admin\ProductSizeController@show')->name('product-sizes.show');
    Route::get('product-sizes/{size_id}/edit','Admin\ProductSizeController@edit')->name('product-sizes.edit');
    Route::put('product-sizes/{size_id}','Admin\ProductSizeController@update')->name('product-sizes.update');
    Route::delete('product-sizes/{size_id}','Admin\ProductSizeController@destroy')->name('product-sizes.destroy');
    Route::get('product-photos/{product_id}','Admin\ProductPhotoController@create')->name('product-photos.create');
    Route::post('product-photos','Admin\ProductPhotoController@store')->name('product-photos.store');
    Route::get('/','Admin\PagesController@index')->name('index');
});
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
