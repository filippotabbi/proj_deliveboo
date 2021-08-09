<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/restaurants', 'Api\RestaurantController@index');
Route::get('/categories', 'Api\CategoryController@index');
Route::get('/filter-restaurants/{category}', 'Api\RestaurantController@filterRestaurants');
Route::get('/search-restaurant/{query}', 'Api\RestaurantController@searchRestaurant');
Route::get('/dishes/{restaurantId}', 'Api\DishController@index');

//orderController
Route::get('/ordersShow/{restaurant}', 'Api\OrderController@ordersShow');
Route::get('/totalForMonth/{restaurant}', 'Api\OrderController@totalForMonth');

