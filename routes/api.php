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

Route::group(['prefix' => 'v1', 'middleware' => 'multiauth:api-admin'], function(){
    Route::get('/users', 'API\UserController@index');
    Route::delete('/user/{user}', 'API\UserController@destroy');
    Route::get('/mechanics', 'API\MechanicController@index');
    Route::delete('/mechanic/{mechanic}', 'API\MechanicController@destroy');
    Route::get('/reviews', 'API\ReviewController@index');
    Route::get('/review/{review}', 'API\ReviewController@show');
});

Route::group(['prefix' => 'v1'], function() {
	Route::post('/register/validate/email', 'API\RegisterController@validateEmail');
	Route::post('/register/validate/phone', 'API\RegisterController@validatePhone');
	Route::post('/register', 'API\RegisterController@store');
});


Route::group(['prefix' => 'v1', 'middleware' => 'multiauth:api'], function(){
    Route::get('/user', 'API\UserController@show');
    Route::put('/user', 'API\UserController@update');
    Route::post('/user/logout', 'API\AuthController@logout');
    Route::post('/search/mechanic', 'API\SearchController@index');
    Route::post('/user/request', 'API\OfferController@store');
    Route::post('/user/request/status', 'API\OfferController@status');
    Route::post('/user/request/cancel', 'API\OfferController@cancelRequest');
    Route::post('/user/request/review', 'API\OfferController@review');
});

Route::group(['prefix' => 'v1', 'middleware' => 'multiauth:api-mechanic'], function(){
    Route::get('/mechanic', 'API\MechanicController@show');
    Route::put('/mechanic', 'API\MechanicController@update');
    Route::post('/mechanic/logout', 'API\AuthController@logout');
    Route::post('/mechanic/request/status', 'API\OfferController@mechanicStatus');
    Route::post('/mechanic/request/accept', 'API\OfferController@acceptRequest');
    Route::post('/mechanic/request/finish', 'API\OfferController@finishRequest');
});
