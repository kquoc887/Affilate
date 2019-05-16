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
    return view('affilate.master');
});

Route::get('login', function() {
    return view('affilate.login');
})->name('getlogin');


Route::get('dashboard', function() {
    return view('affilate.publisher.dashboard');
})->name('dashboard');

Route::get('sale-profit', function() {
    return view('affilate.publisher.sale_profit');
})->name('sale-profit');

Route::get('advertiser', function() {
    return view('affilate.publisher.advertisers');
})->name('advertiser');


