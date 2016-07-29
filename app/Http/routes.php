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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('index', ['as' => 'home', 'uses' => 'HomeController@index']);

//Login
//Route::get('auth/login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('auth/logout', ['as' => 'Logout', 'uses' => 'Auth\AuthController@logout']);

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
Route::get('product/{id}', 'ProductController@showDetail');

Route::post('cart/add', 'CartController@add');
Route::post('cart/delete', 'CartController@delete');

Route::get('checkout', 'CheckoutController@getCheckout');
Route::post('checkout', 'CheckoutController@postCheckout');

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
Route::group(['prefix' => 'admin'], function(){
    Route::get('auth/login', ['as' => 'getLoginAdmin', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('auth/login', ['as' => 'postLoginAdmin', 'uses' => 'Auth\AuthController@postLogin']);

    Route::group(['prefix' => '/', 'middleware' => 'auth'], function() {
        Route::get('/', [
            'as' => 'admin.home',
            'uses' => 'HomeController@adminHomePage'
        ]);
        Route::get('/home', [
            'as' => 'admin.home',
            'uses' => 'HomeController@adminHomePage'
        ]);
    });

    Route::group(['prefix' => 'category'], function(){
        Route::get('add', [
            'as' => 'admin.category.getAddCat',
            'uses' => 'CategoryController@getAddCat'
        ]);
        Route::post('add', [
            'as' => 'admin.category.postAddCat',
            'uses' => 'CategoryController@postAddCat'
        ]);
        Route::get('edit', [
            'as' => 'admin.category.getEditCat',
            'uses' => 'CategoryController@getEditCat'
        ]);
        Route::get('list', [
            'as' => 'admin.category.getListCat',
            'uses' => 'CategoryController@getListCat'
        ]);
    });

    Route::group(['prefix' => 'product', 'middleware' => 'auth'], function(){
        Route::get('add', [
            'as' => 'admin.product.getAddPro',
            'uses' => 'ProductController@getAddPro'
        ]);
        Route::post('add', [
            'as' => 'admin.product.postAddPro',
            'uses' => 'ProductController@postAddPro'
        ]);
        Route::get('edit', [
            'as' => 'admin.product.getEditPro',
            'uses' => 'ProductController@getEditPro'
        ]);
        Route::get('list', [
            'as' => 'admin.product.getListPro',
            'uses' => 'ProductController@getListPro'
        ]);
    });

    Route::group(['prefix' => 'order'], function(){
        Route::get('list', [
            'as' => 'admin.order.list',
            'uses' => 'OrderController@getList'
        ]);
        Route::get('detail/{id}', [
            'as' => 'admin.order.detail',
            'uses' => 'OrderController@getDetail'
        ]);
        Route::post('detail/{id}', ['
            as' => 'admin.order.detail',
            'uses' => 'OrderController@postChange'
        ]);
        Route::get('edit/{id}', [
            'as' => 'admin.order.edit',
            'uses' => 'OrderController@getEdit'
        ]);
        Route::post('edit/{id}', [
            'as' => 'admin.order.edit',
            'uses' => 'OrderController@postEdit'
        ]);
        Route::get('add', ['as' =>
            'admin.order.add',
            'uses' => 'OrderController@getAdd'
        ]);
        Route::post('add', [
            'as' => 'admin.order.add',
            'uses' => 'OrderController@postAdd'
        ]);
    });
});

