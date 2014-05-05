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
	if (Auth::check()) {
		return Redirect::to('dashboard');
	} else {
		return View::make('start');
	}
});

Route::resource('users', 'UsersController');
Route::resource('summoners', 'SummonersController');
Route::resource('champions', 'ChampionsController');
Route::resource('quests', 'QuestsController');
Route::resource('items', 'ItemsController');
Route::resource('products', 'ProductsController');

// Admin Functions
Route::get('admin/refresh_champions', array('uses' => 'ChampionsController@refresh_champions'));
Route::get('admin/refresh_items', array('uses' => 'BaseController@refresh_items'));
Route::get('admin/create_daily', array('uses' => 'BaseController@create_daily'));

// Base Controller
Route::get('403', array('uses' => 'BaseController@noAccess'));
Route::get('404', array('uses' => 'BaseController@notFound'));
Route::post('search', array('uses' => 'BaseController@search_summoner'));

// Users Controller
Route::post('/users/store', 'UsersController@store');
Route::post('login', array('uses' => 'UsersController@doLogin'));

Route::get('edit_summoner', 'UsersController@edit_summoner');
Route::get('dashboard', 'UsersController@dashboard');
Route::get('login', array('uses' => 'UsersController@showLogin'));
Route::get('verify', array('uses' => 'UsersController@verify'));
Route::get('refresh_games', array('uses' => 'UsersController@refresh_games'));
Route::get('logout', array('uses' => 'UsersController@doLogout'));
Route::get('register', array('uses' => 'UsersController@create'));
Route::get('/user_friend/{id}', array('uses' => 'UsersController@makeFriend'));

Route::get('/achiv/{type}/{factor}/{id}', array('uses' => 'UsersController@becomeAchievement'));

Route::get('/level_update', array('uses' => 'UsersController@refresh_level'));
Route::get('/users/makeadmin/{id}', array('uses' => 'UsersController@makeAdmin'));
Route::post('users/update_summoner', array('uses' => 'UsersController@update_summoner'));
Route::get('summoner/{region?}/{name?}', 'UsersController@show');


// Quests Controller
Route::post('/quests/create_choose_quest', 'QuestsController@create_choose_quest');
Route::post('/quests/create_random_quest', 'QuestsController@create_random_quest');
Route::get('/quests/check_quest/{quest_id?}', 'QuestsController@check_quest');
Route::get('/quests/reroll_quest/{quest_id?}', 'QuestsController@reroll_quest');
Route::get('/quests/cancel_quest/{quest_id?}', 'QuestsController@cancel_quest');
Route::get('/accept_daily', 'QuestsController@accept_daily');


// Ladders Controller
Route::get('/ladders', 'LaddersController@index');
Route::get('/ladders/refresh_ladder', 'LaddersController@refresh_ladder');
Route::get('/ladders/{year?}/{month?}', 'LaddersController@index');


// Products Controller
Route::get('/shop', 'ProductsController@index');