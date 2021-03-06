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
Route::get('/login/{driver}', 'API\AuthController@redirectToProvider');
Route::get('/login/{driver}/callback', 'API\AuthController@handleProviderCallback');
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
Route::get('/products/{id}','API\ProductController@show');

Route::post('/comments/create','API\CommentController@create');
Route::get('/comments','API\CommentController@index');

Route::get('/discounts','API\DiscountController@index');

Route::get('/shipments','API\ShipmentController@index')->middleware('auth:sanctum');
Route::post('/shipments-add','API\ShipmentController@add_product')->middleware('auth:sanctum');
Route::post('/shipments-update/{shipment_id}','API\ShipmentController@update_product')->middleware('auth:sanctum');
Route::delete('/shipments-delete/{shipment_id}','API\ShipmentController@delete_product')->middleware('auth:sanctum');

Route::get('/favorites','API\FavoriteController@index')->middleware('auth:sanctum');
Route::post('/favorites-add','API\FavoriteController@addToFavorites')->middleware('auth:sanctum');
Route::delete('/favorites-delete/{fav_id}','API\FavoriteController@removeFromFavorites')->middleware('auth:sanctum');

Route::get('/orders','API\OrderController@index')->middleware('auth:sanctum');
Route::post('/orders','API\OrderController@store')->middleware('auth:sanctum');
Route::get('/orders/{order_id}','API\OrderController@show')->middleware('auth:sanctum');

Route::get('/comparison','API\ComparisonController@index')->middleware('auth:sanctum');
Route::post('/comparison-add/{product_id}','API\ComparisonController@store')->middleware('auth:sanctum');
Route::delete('/comparison-delete/{product_id}','API\ComparisonController@destroy')->middleware('auth:sanctum');

Route::get('/last-viewed','API\ProductViewedController@lastViewed')->middleware('auth:sanctum');
Route::get('/recommended-products','API\ProductViewedController@recommendedProducts')->middleware('auth:sanctum');
