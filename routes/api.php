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

Route::post('register', 'AuthController@register')->name('register');
Route::post('login', 'AuthController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('people/list', 'PeopleController@show');
    Route::get('logout', 'AuthController@logout')->name('logout');
});
