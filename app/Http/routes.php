<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('index', 'HomeController@index');

//Login
//Route::get('auth/login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);

//Facebook login
//Route::get('facebook', function () {
//    return view('facebookAuth');
//});
Route::get('auth/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleFacebookCallback');

//Register
//Route::get('auth/register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('refereshcapcha', 'HelperController@refereshCapcha');

Route::get('category', function () {
    return view('pages.category');
});
Route::get('product', function () {
    return view('pages.product');
});
Route::get('checkout', function () {
    return view('pages.checkout');
});

Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.verify', $data, function ($message) {

        $message->from('phucanh94@gmail.com', 'Learning Laravel');

        $message->to('phucanh48@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});

Route::post('checkexist/email', 'HelperController@checkEmail');
Route::post('check/captcha', 'HelperController@checkCaptcha');

//----------------------- Admin zone -------------------------------//
Route::group(['prefix' => 'adpage'], function () {
    Route::get('/', 'HomeController@adminHomePage');

});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

