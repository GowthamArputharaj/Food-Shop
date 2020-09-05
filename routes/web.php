<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// to store new product to db
Route::post('/food/store', 'FoodsController@store')->name('food.store');

// to purchase product
Route::post('/buy', 'FoodsController@buy')->middleware('auth');

// root url
Route::get('/', function(){
    return view('foodsecond');
})->name('foodsecond');

// api call to get all foods from db
Route::get('/foods', 'FoodsController@foods');

// to get all food items in shop
Route::get('/cart', 'FoodsController@cart');

Route::resource('/food', 'FoodsController');
