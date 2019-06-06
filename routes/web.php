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


// route for reset password


Route::post('check-email', 'ResetPasswordController@checkEmail')->name('check-email');

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
        Route::get('getDataOrder', 'PublisherController@getDataOrder')->name('publisher.getDataOrder');
        Route::get('getNearestOrder', 'PublisherController@getNearestOrder')->name('publisher.getNearestOrder');
        Route::get('editProfile', 'PublisherController@getEditProfile')->name('publisher.geteditProfile');
        Route::post('posteditProfile', 'PublisherController@postEditProfile')->name('publisher.postEditProfile');
        Route::get('infoUser','PublisherController@getInfoUser')->name('publisher.infoUser');
        Route::get('searchOrder', 'PublisherController@searchOrder')->name('publisher.searchOrder');
        Route::get('payment', 'PublisherController@getPayment')->name('publisher.payment');
        Route::get('OrderSuccess','PublisherController@getOrderSuccess' )->name('publisher.getOrderSuccess');
    });
    Route::group(['prefix' => 'advertiser'], function () {
        Route::get('/', 'TestController@index')->name('home');
        Route::get('saleprofit','TestController@getSaleProfit')->name('saleProFit');
        Route::get('getDataUser','TestController@getDataUserLink')->name('getDataUser');
        Route::get('getDataProfit','TestController@getDataSaleProfit')->name('getDataSaleProfit');
        Route::post('lockPublisher','TestController@lock_n_unlock_publisher')->name('lockPub');
        Route::get('SaleProfitFromToDate','TestController@getSaleProfitFromToDate')->name('SaleProfitFromToDate');
        Route::get('Payment','TestController@getPaymentAllUser')->name('payment');
        Route::get('postPayment','TestController@postPayment')->name('postPayment');
        Route::get('getDataPayment','TestController@getDataPayment')->name('getDataPayment');
        Route::post('pay', 'TestController@postPay')->name('postPay');
        Route::get('getCustomFilterData','TestController@getCustomFilterData')->name('getCustomData');
    });
});
