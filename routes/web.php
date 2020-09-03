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

Route::get('/', function () {
    return view('welcome');
}); 


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('abs.dashboard');
    })->name('dashboard');

    Route::get('/food/create', function() {
        return view('food.create');
    })->name('food.create');
    
    Route::post('/food/store', 'FoodsController@store')->name('food.store');

});

// Route::resource('/food', 'FoodsController');

Route::get('/food', 'FoodsController@index')->name('food.index');

Route::resource('/food-api', 'FoodsApiController');

Route::resource('/foodcart', 'FoodsUserApiController');

Route::get('food-api/inc/{id}', 'FoodsUserApiController@quantityIncrement');
Route::get('food-api/dec/{id}', 'FoodsUserApiController@quantityDecrement');

Route::put('food-user-api/inc/{id}', 'FoodsUserApiController@quantityIncrement');
Route::get('food-user-api/', 'FoodsUserApiController@index');

Route::put('food-user-api/dec/{id}', 'FoodsUserApiController@quantityDecrement');

Route::get('food-api/dec/{id}', 'FoodsUserApiController@quantityDecrement');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
