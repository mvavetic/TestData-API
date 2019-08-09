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
    Route::get('people.list', 'Api\PeopleController@index');
    Route::get('person.info', 'Api\PeopleController@show');
    Route::post('person.create', 'Api\PeopleController@create');
    Route::patch('person.update', 'Api\PeopleController@edit');
    Route::delete('person.delete', 'Api\PeopleController@destroy');
    // Country controller
    Route::get('countries.list', 'Api\CountryController@index');
    Route::get('country.info', 'Api\CountryController@show');
    // City controller
    Route::get('cities.list', 'Api\CityController@index');
    Route::get('city.info', 'Api\CityController@show');
    Route::post('city.create', 'Api\CityController@create');
    Route::patch('city.update', 'Api\CityController@edit');
    Route::delete('city.delete', 'Api\CityController@destroy');
    // Sport controller
    Route::get('sports.list', 'Api\SportController@index');
});
