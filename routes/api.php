<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
	'prefix' => 'blogs'
], function () {
	Route::post('/', 'BlogsController@store');
	Route::put('{id}', 'BlogsController@update');
	Route::get('/', 'BlogsController@index');
	Route::get('{id}', 'BlogsController@show');
	Route::delete('{id}', 'BlogsController@destroy');
});
Route::group([
	'prefix' => 'shop'
], function () {
	Route::post('/', 'ShopController@store');
	Route::put('{id}', 'ShopController@update');
	Route::get('/', 'ShopController@index');
	Route::get('{id}', 'ShopController@show');
	Route::delete('{id}', 'ShopController@destroy');
});

Route::group([
	'prefix' => 'auth',
	'namespace' => 'Auth'
], function () {
	Route::post('login', 'AuthController@login');
	// Route::post('register', 'AuthController@register');
	Route::get('logout', 'AuthController@logout');
});
