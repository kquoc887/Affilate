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



//route of QuocKhanh
Route::get('login', function() {
    return view('affilate.login');
})->name('getLogin');

// route dùng để xác nhận đăng ký của user
Route::get('active-user/{id}', 'Auth\VerificationController@activeUser')->name('verifyUser');


Route::get('logout', 'Auth\LoginController@getLogout')->name('getLogout');

//route đăng kí PhuocNguyen
Route::post("checkLogin",'Auth\LoginController@checkLogin')->name('checkLogin');
Route::post("postSignUp",'Auth\RegisterController@create')->name('postSignUp');
Route::post('postLogin','Auth\LoginController@postLogin')->name('postLogin');


Route::group(['prefix' => 'app', 'middleware' => 'appLogin'], function () {
    Route::group(['prefix' => 'publisher'], function () {
        Route::get('/', 'PublisherController@index')->name('publisher.dashboard');
        
        Route::get('sale-profit', 'PublisherController@getSaleProfit')->name('publisher.sale-profit');
        
        Route::get('advertiser', 'PublisherController@getAdvertiser')->name('publisher.advertiser');

        Route::get('getAdvertiser', 'PublisherController@getDataAdvertiser')->name('publisher.getAdvertiser');
    });

    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('/', 'TestController@index')->name('home');

        Route::get('saleprofit','TestController@getSaleProfit');
        
    });
});



