<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', 'RestaurantController@index')->name('index');
Route::get('restaurants/{restaurant}','RestaurantController@show')->name('restaurants.show');
Route::get('addDish/{dish}','CartController@addDish')->name('addDish');
Route::get('orders','OrderController@index')->name('orders.index');
Route::post('orders','OrderController@store')->name('orders.store');
Route::get('orders/orderSent','OrderController@orderDone')->name('orders.confirmation');



Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
  ->group(function () {
    Route::resource('/restaurants', 'RestaurantController');
    //Route::resource('/categories', 'CategoryController');
    Route::resource('/dishes', 'DishController')->except([
      'create'
    ]);
    Route::get('/dishes/create/{restaurant}', 'DishController@create')->name('dishes.create');
    Route::get('/orders/{restaurant}', 'OrderController@show')->name('orders.show');
    Route::get('/statistics/{restaurant}', 'StatsController@show')->name('statistics.show');
    Route::get('/users', 'UserController@index')->name('user.index');
  });
