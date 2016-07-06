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
Route::get('auth/login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);

//Register
Route::get('auth/register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

//----------------------- Admin zone -------------------------------//
Route::group(['prefix' => 'adpage'], function () {
    Route::get('/', 'HomeController@adminHomePage');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

