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
})->name('getLogin')->middleware('guest');
// route dùng để xác nhận đăng ký của user
Route::get('active-user/{id}', 'Auth\VerificationController@activeUser')->name('verifyUser');
Route::get('logout', 'Auth\LoginController@getLogout')->name('getLogout');
//route đăng kí PhuocNguyen
Route::post("checkLogin",'Auth\LoginController@checkLogin')->name('checkLogin');
Route::post("postSignUp",'Auth\RegisterController@create')->name('postSignUp');
Route::post('postLogin','Auth\LoginController@postLogin')->name('postLogin');
//route forgot password by Phuocnguyen
Route::get('forgotPass',function(){
    return view('affilate.forgetpass');
})->name('forgotPass');
Route::post('reset-password','ResetPasswordController@sendMail')->name('reset-password');
Route::get('reset-token', 'ResetPasswordController@getFormReset')->name('reset-token');
Route::post('reset/{token}', 'ResetPasswordController@reset')->name('reset');
Route::group(['prefix' => 'app', 'middleware' => 'appLogin'], function () {
    Route::group(['prefix' => 'publisher'], function () {
        Route::get('/', 'PublisherController@index')->name('publisher.dashboard');
        
        Route::get('sale-profit', 'PublisherController@getSaleProfit')->name('publisher.sale-profit');
        
        Route::get('advertiser', 'PublisherController@getAdvertiser')->name('publisher.advertiser');
        Route::get('getAdvertiser', 'PublisherController@getDataAdvertiser')->name('publisher.getAdvertiser');
        Route::post('registerAdvertiser', 'PublisherController@registerAdvertiser')->name('publisher.registerAdvertiser');
        Route::get('getDataOrg', 'PublisherController@getDataOrg')->name('publisher.getDataOrg');
    });
    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('/', 'TestController@index')->name('home');
        Route::get('saleprofit','TestController@getSaleProfit');
        Route::get('getDataUser','TestController@getDataUserLink')->name('getDataUser');
        
    });
});
Route::get('set-cookie', function() {
    session(['test' => 'value1']);
});
Route::get('get-cookie', function() {
    dd(cookie('__cfduid'));
});
