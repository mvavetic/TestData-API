<?php

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

Route::post('register', 'Auth\AuthController@register')->name('register');
Route::post('login', 'Auth\AuthController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('people.list', 'Api\PeopleController@index');
    Route::post('people.info', 'Api\PeopleController@show');
    Route::get('logout', 'Auth\AuthController@logout')->name('logout');
});
