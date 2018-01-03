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

Route::get('/api/users', 'ApiController@users');
Route::get('/api/locations', 'ApiController@locations');
Route::post('/api/location/submit', 'ApiController@upsertLocation');
Route::get('/api/foods', 'ApiController@foods');
Route::post('/api/food/submit', 'ApiController@upsertFood');
Route::get('/api/getFromProduction', 'ApiController@getFromProduction');