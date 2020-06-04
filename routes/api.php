<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login','API\AuthController@login')->name('api.login');
Route::post('/register','API\AuthController@register')->name('api.register');
Route::post('/logout','API\AuthController@logout')->name('api.logout')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/update-user','API\AuthController@updateUser')->name('user.update')->middleware('auth:sanctum');
Route::post('/update-photo','API\AuthController@updatePhoto')->middleware('auth:sanctum');
Route::post('/change-password','API\AuthController@changePassword')->name('user.change-password')->middleware('auth:sanctum');

Route::get('/categories','API\CategoryController@index');
Route::get('/brands','API\BrandController@index');
Route::get('/products','API\ProductController@index');
