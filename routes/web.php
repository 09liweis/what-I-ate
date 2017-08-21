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

Route::get('/home', 'HomeController@index');
Route::get('/contact', 'PageController@contact');
Route::resource('/cds', 'CdController');
Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::post('/products', 'ProductController@store');

Route::get('/admin', 'AdminController@admin');
Route::get('/admin/locations', 'AdminController@locations');
Route::get('/admin/location/{id}', 'AdminController@location');
Route::post('/admin/location/create', 'AdminController@createLocation');
Route::put('/admin/location/update/{id}', 'AdminController@updateLocation');
Route::get('/dashboard', 'AdminController@dashboard');

Route::get('/user/food', 'AdminController@index');
Route::get('/user/food/{id}', 'AdminController@detail');
Route::post('/user/food/create', 'AdminController@create');
Route::put('/user/food/update/{id}', 'AdminController@update');
Route::delete('/user/food/delete/{id}', 'AdminController@delete');

Route::get('/api', 'AdminController@api');

Route::get('/food/{id?}', 'FoodController@index');
Route::get('/location/{id?}', 'LocationController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
