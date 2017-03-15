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

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', 'AdminController@dashboard');

Route::get('/user/food', 'AdminController@index');

Route::get('/user/food/{id}', 'AdminController@detail');

Route::post('/user/food/create', 'AdminController@create');

Route::put('/user/food/update/{id}', 'AdminController@update');

Route::delete('/user/food/delete/{id}', 'AdminController@delete');

Route::get('/api', 'AdminController@api');

Route::get('/food', 'FoodController@index');