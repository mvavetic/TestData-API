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
Route::get('logout', 'Auth\AuthController@logout')->name('logout')->middleware('auth:api');

Route::group(['middleware' => 'auth:api', 'cors'], function() {
    // People controller
    Route::post('people.list', 'Api\PeopleController@index');
    Route::post('person.info', 'Api\PeopleController@show');
    Route::post('person.create', 'Api\PeopleController@create');
    Route::patch('person.update', 'Api\PeopleController@update');
    Route::delete('person.delete', 'Api\PeopleController@destroy');
    // County controller
    Route::post('countries.list', 'Api\CountryController@index');
    Route::post('country.info', 'Api\CountryController@show');
    // City controller
    Route::post('cities.list', 'Api\CityController@index');
    Route::post('city.info', 'Api\CityController@show');
});
