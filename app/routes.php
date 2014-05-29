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
Route::resource('blogs', 'BlogsController');


// Admin Functions
Route::get('admin/refresh_champions', array('uses' => 'ChampionsController@refresh_champions'));
Route::get('admin/refresh_items', array('uses' => 'BaseController@refresh_items'));
Route::get('admin/create_daily', array('uses' => 'BaseController@create_daily'));


// Blog Controller
Route::post('create_comment', array('uses' => 'BlogsController@create_comment'));



// Base Controller
Route::get('403', array('uses' => 'BaseController@noAccess'));
Route::get('404', array('uses' => 'BaseController@notFound'));
Route::post('search', array('uses' => 'BaseController@search_summoner'));
Route::get('search', array('uses' => 'BaseController@search_summoner'));


// Champions Controller
Route::get('/champions/{name}', array('uses' => 'ChampionsController@show'));


// Timelines Controller
Route::get('/timeline', array('uses' => 'TimelinesController@index'));


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
Route::get('/accept_friend/{id}', array('uses' => 'UsersController@acceptFriend'));
Route::get('/remove_friend/{id}', array('uses' => 'UsersController@removeFriend'));
Route::get('/update_level_table', array('uses' => 'UsersController@update_level_table'));
Route::get('/level_update', array('uses' => 'UsersController@refresh_level'));
Route::get('/users/makeadmin/{id}', array('uses' => 'UsersController@makeAdmin'));
Route::post('users/update_summoner', array('uses' => 'UsersController@update_summoner'));
Route::get('summoner/{region?}/{name?}', 'UsersController@show');
Route::get('/settings', 'UsersController@edit');


// Quests Controller
Route::post('/quests/create_choose_quest', 'QuestsController@create_choose_quest');
Route::post('/quests/create_random_quest', 'QuestsController@create_random_quest');
Route::post('/quests/create_challenge', 'QuestsController@create_challenge');
Route::get('/quests/check_quest/{quest_id?}', 'QuestsController@check_quest');
Route::get('/quests/reroll_quest/{quest_id?}', 'QuestsController@reroll_quest');
Route::get('/quests/cancel_quest/{quest_id?}', 'QuestsController@cancel_quest');
Route::get('/accept_daily', 'QuestsController@accept_daily');
Route::get('/cancel_challenge', 'QuestsController@cancel_challenge');


// Challenges Controller
Route::get('/finish_challenge', 'ChallengesController@finish_challenge');


// Ladders Controller
Route::get('/ladders', 'LaddersController@index');
Route::get('/ladders/refresh_ladder', 'LaddersController@refresh_ladder');
Route::get('/ladders/{year?}/{month?}', 'LaddersController@index');


// Notification Controller
Route::get('/notifications/delete_note/{id?}', 'NotificationsController@delete_note');


// Shop Controller
Route::get('shop', 'ProductsController@index');
Route::get('shop/buy/{id}', 'ProductsController@buy');
Route::get('shop/offers', 'ProductsController@offers');
Route::get('shop/buy_qp', 'ProductsController@buy_qp');
Route::get('shop/riot_points', 'ProductsController@riot_points');
Route::get('shop/ep_boosts', 'ProductsController@ep_boosts');
Route::get('shop/backgrounds', 'ProductsController@backgrounds');
Route::get('shop/skins', 'ProductsController@skins');
Route::get('shop/history', 'ProductsController@history');


// Pages
Route::get('contact', function()
{
	return View::make('pages.contact');
});
Route::get('impress', function()
{
	return View::make('pages.impress');
});
Route::get('faq', function()
{
	return View::make('pages.faq');
});
Route::get('team', function()
{
	return View::make('pages.team');
});


// App Login
Route::get('/app_login', array('before' => 'api_login', function()
{
	$user = Auth::user();
    return "\n\nHallo $user->summoner_name\n";
}));


// Route group for API versioning
Route::group(array('prefix' => 'api/v1', 'before' => 'api_login'), function()
{
    Route::get('user', 'ApiController@user');
});