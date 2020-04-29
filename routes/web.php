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
Route::name('admin.')->group(function (){
    Route::get('/','Admin\PagesController@index')->name('index');
    Route::get('/users','Admin\UsersController@index')->name('users');
    Route::get('/users/create','Admin\UsersController@create')->name('users.create');
    Route::get('/users/{id}','Admin\UsersController@show')->name('users.show');
    Route::get('/users/{id}/edit','Admin\UsersController@edit')->name('users.edit');
    Route::delete('/users/{id}','Admin\UsersController@destroy')->name('users.delete');
});
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');
