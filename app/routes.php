<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('start');
});

Route::resource('users', 'UsersController');
Route::resource('summoners', 'SummonersController');

Route::post('/users/store', 'UsersController@store');
Route::get('edit_summoner', 'UsersController@edit_summoner');
Route::get('login', array('uses' => 'UsersController@showLogin'));
Route::get('403', array('uses' => 'UsersController@noAccess'));
Route::get('verify', array('uses' => 'UsersController@verify'));
Route::get('refresh_games', array('uses' => 'UsersController@refresh_games'));
Route::post('login', array('uses' => 'UsersController@doLogin'));
Route::get('logout', array('uses' => 'UsersController@doLogout'));
Route::get('register', array('uses' => 'UsersController@create'));
Route::get('/users/makeadmin/{id}', array('uses' => 'UsersController@makeAdmin'));

Route::post('users/update_summoner', array('uses' => 'UsersController@update_summoner'));