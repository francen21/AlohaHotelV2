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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/book', 'OtherpageController@book')->name('book');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\/_.]+)?');
Route::post('/checkout', 'OtherController@checkout');
Route::post('/changeroom', 'OtherController@changeroom');
Route::post('/roomstatus', 'OtherController@roomstatus');
