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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'OrderController@home');
Route::resource('/orders', 'OrderController');
Route::get('/getPizzas', 'OrderController@getPizzas');
Route::get('/userAuth', 'OrderController@checkUserAuth');
Route::get('/getPrice/{id}', 'OrderController@getPrice');
Route::get('/getSize/{id}', 'OrderController@getSize');
