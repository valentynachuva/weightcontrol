<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function() {
   return view('welcome');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/store', 'WeightController@store')->name('create_weight');
//Route::get('/store', 'WeightController@store')->name('create_weight');
//Route::put('/update', 'WeightController@update')->name('update');
Auth::routes();
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('weights', 'WeightController@index');
Route::get('weights/{id}', 'WeightController@show');
Route::post('weights', 'WeightController@store');
Route::put('weights/{id}', 'WeightController@update');
Route::delete('weights/{id}', 'WeightController@delete');
});