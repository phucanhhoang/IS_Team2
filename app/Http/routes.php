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

//AJAX load product
Route::post('load-product', 'HomeController@loadProduct');

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

Route::get('category/{id}/{name_cate}',['as'=>'cate','uses'=>'ProductController@getProFollowCate']);
Route::get('product/{id}', 'ProductController@showDetail');

Route::post('cart/add', 'CartController@add');
Route::post('cart/delete', 'CartController@delete');
Route::post('cart/change', 'CartController@change');

Route::get('checkout', 'CheckoutController@getCheckout');
Route::post('checkout', 'CheckoutController@postCheckout');

Route::get('register/verify/sendemail/{email}', 'Auth\AuthController@sendMailVerify');
Route::get('register/verify/{confirmation_code}', 'Auth\AuthController@confirm');

Route::post('checkexist/phone', 'HelperController@checkPhone');
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

    Route::delete('sizecolor/delete/{id}', [
        'as' => 'admin.sizecolor.delete',
        'uses' => 'CategoryController@deleteSize'
    ]);

    Route::get('sizecolor', [
        'as' => 'sizecolor',
        'uses' => 'ProductController@getSizeColor'
    ]);
    Route::post('newsize', [
        'as' => 'admin.product.newSize',
        'uses' => 'ProductController@newSize'
    ]);
    Route::post('newcat', [
        'as' => 'admin.category.newCatParent',
        'uses' => 'CategoryController@newCatParent'
    ]);

    Route::post('newcolor', [
        'as' => 'admin.category.newColor',
        'uses' => 'CategoryController@newColor'
    ]);


    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');


    Route::group(['prefix' => 'order'], function(){
        Route::get('list', [
            'as' => 'admin.order.list',
            'uses' => 'OrderController@getList'
        ]);
        Route::get('detail/{id}', [
            'as' => 'admin.order.detail',
            'uses' => 'OrderController@getDetail'
        ]);
        Route::post('detail/{id}', [
            'as' => 'admin.order.detail',
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
        Route::post('pro_change', [
            'as' => 'admin.order.pro_change',
            'uses' => 'OrderController@proChange'
        ]);
    });
});

