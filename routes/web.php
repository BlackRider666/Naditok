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
    Route::resource('product-sizes','Admin\ProductSizeController');
    Route::get('/','Admin\PagesController@index')->name('index');
});
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
