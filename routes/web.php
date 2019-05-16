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
    return view('affilate.web.home');
});
// route get of all page
Route::resource('home','TestController');
Route::get('saleprofit','TestController@getSaleProfit');