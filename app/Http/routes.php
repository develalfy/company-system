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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function () {
    // Authentication routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']); //todo:check this

    // Registration routes...
    if (Schema::hasTable('users')) {
        if (\App\User::all()->isEmpty()) {
            Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
            Route::post('register', 'Auth\AuthController@postRegister');
        }
    }
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'admin.index', 'uses' => 'HomeController@index']);
    Route::controller('/categories', 'CategoriesController');
    Route::controller('/items', 'ItemsController');
});

//Route::controller('rapyd-demo','\Zofe\Rapyd\Demo\DemoController');

