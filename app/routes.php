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


Route::get('/', array('uses' => 'BaseController@start'));

Route::resource('users', 'UsersController');
Route::resource('summoners', 'SummonersController');
Route::resource('champions', 'ChampionsController');
Route::resource('quests', 'QuestsController');
Route::resource('items', 'ItemsController');
Route::resource('products', 'ProductsController');
Route::resource('blogs', 'BlogsController');
Route::controller('password', 'RemindersController');
Route::resource('payment', 'PaypalPaymentController');

// Admin Functions
Route::get('admin/refresh_champions', array('uses' => 'ChampionsController@refresh_champions'));
Route::get('admin/refresh_items', array('uses' => 'BaseController@refresh_items'));
Route::get('admin/create_daily', array('uses' => 'BaseController@create_daily'));
Route::get('admin/generate_keys', array('uses' => 'UsersController@generate_keys'));
Route::get('admin/generate_supporter_keys', array('uses' => 'UsersController@generate_supporter_keys'));
Route::get('admin/update_games/{user_id}', array('uses' => 'UsersController@admin_update_games'));
Route::get('admin/login_as/{user_id}', array('uses' => 'UsersController@admin_login_as'));


// Blog Controller
Route::post('create_comment', array('uses' => 'BlogsController@create_comment'));


// Setting
Route::post('/settings/update_email', array('uses' => 'UsersController@update_email'));
Route::get('/settings/skins', array('uses' => 'UsersController@skins'));
Route::post('/settings/update_timeline_settings', array('uses' => 'UsersController@update_timeline_settings'));
Route::get('/settings/title', array('uses' => 'UsersController@titles'));
Route::post('/settings/update_title', array('uses' => 'UsersController@update_title'));
Route::post('/settings/save_livestream', array('uses' => 'UsersController@save_livestream'));
Route::get('/settings/livestream', array('uses' => 'UsersController@livestream'));

// Forum Controller
Route::get('/forum/create_topic/{category_id}/new', array('uses' => 'ForumController@create_topic'));
Route::get('/forum/edit_topic/{topic_id}/{user_id}', array('uses' => 'ForumController@edit_topic'));
Route::get('/forum/reply/{category_id}/{topic_id}', array('uses' => 'ForumController@reply'));
Route::get('/forum/edit/{reply_id}/{user_id}', array('uses' => 'ForumController@edit_reply'));
Route::get('/forum/close_topic/{topic_id}', array('uses' => 'ForumController@close_topic'));
Route::get('/forum/open_topic/{topic_id}', array('uses' => 'ForumController@open_topic'));
Route::get('/forum/delete_topic/{topic_id}', array('uses' => 'ForumController@delete_topic'));
Route::get('/forum', array('uses' => 'ForumController@index'));
Route::get('/forum/{category_id}/{url_name}', array('uses' => 'ForumController@category'));
Route::get('/forum/{category_id}/topic/{topic_id}', array('uses' => 'ForumController@topic'));


Route::post('/forum/{category_id}/{url_name}/{topic_id}/{topic_url_name}/save_reply', array('uses' => 'ForumController@save_reply'));
Route::post('/forum/{url_name}/create_topic/save_topic', array('uses' => 'ForumController@save_topic'));
Route::post('/forum/{url_name}/create_topic/editsave_topic', array('uses' => 'ForumController@editsave_topic'));
Route::post('/forum/{url_name}/create_topic/editsave_reply', array('uses' => 'ForumController@editsave_reply'));

// Base Controller
Route::get('403', array('uses' => 'BaseController@noAccess'));
Route::get('404', array('uses' => 'BaseController@notFound'));
Route::get('api_error', array('uses' => 'BaseController@api_error'));
Route::post('search', array('uses' => 'BaseController@search_summoner'));
Route::post('save_summoner', array('uses' => 'BaseController@save_summoner'));
Route::get('search', array('uses' => 'BaseController@search_summoner'));
Route::get('register_summoner', array('uses' => 'BaseController@register_summoner'));
Route::get('testcase', array('uses' => 'BaseController@test'));
Route::get('/ipn', array('uses' => 'BaseController@ipn'));


// Champions Controller
Route::get('/champions/{name}', array('uses' => 'ChampionsController@show'));

// Teams Controller
Route::get('/teams/{region}/{name}', array('uses' => 'TeamsController@show'));
Route::get('/teams', array('uses' => 'TeamsController@index'));
Route::get('/teams/create', array('uses' => 'TeamsController@create'));
Route::get('/teams/{region}/{name}/{invite}', array('uses' => 'TeamsController@invite'));
Route::get('/join/{id}/{secret}', array('uses' => 'TeamsController@join'));
Route::post('/teams/store', array('uses' => 'TeamsController@store'));
Route::post('/teams/send_invite', array('uses' => 'TeamsController@send_invite'));
Route::get('/teams/{region}/{name}/remove/{id}', array('uses' => 'TeamsController@remove_member'));
Route::get('/teams/delete_team', array('uses' => 'TeamsController@delete'));
Route::get('/teams/edit', array('uses' => 'TeamsController@edit'));
Route::post('/teams/update', array('uses' => 'TeamsController@update'));
Route::get('/leave_team', array('uses' => 'TeamsController@leave'));
Route::get('/join_request/{team_id}', array('uses' => 'TeamsController@join_request'));


// Timelines Controller
Route::get('/timeline', array('uses' => 'TimelinesController@index'));


// Users Controller
Route::post('/users/store', 'UsersController@store');
Route::post('login', array('uses' => 'UsersController@doLogin'));
Route::post('/check_betakey', 'UsersController@check_betakey');
Route::post('password_remind', 'RemindersController@postRemind');
Route::post('/settings/skins/save', 'UsersController@save_skin');

Route::get('forgot_password', 'RemindersController@getRemind');
Route::get('edit_summoner', 'UsersController@edit_summoner');
Route::get('dashboard', 'UsersController@dashboard');
Route::get('dashboard/streamer', 'UsersController@streamer');
Route::get('login', array('uses' => 'UsersController@showLogin'));
Route::get('verify', array('uses' => 'UsersController@verify'));
Route::get('refresh_games', array('uses' => 'UsersController@refresh_games'));
Route::get('update_gamedata/{gameid}', array('uses' => 'UsersController@update_gamedata'));
Route::get('logout', array('uses' => 'UsersController@doLogout'));
Route::get('register', array('uses' => 'UsersController@create'));
Route::get('/user_friend/{id}', array('uses' => 'UsersController@makeFriend'));
Route::get('/accept_friend/{id}', array('uses' => 'UsersController@acceptFriend'));
Route::get('/remove_friend/{id}', array('uses' => 'UsersController@removeFriend'));
Route::get('/update_level_table', array('uses' => 'UsersController@update_level_table'));
Route::get('/update_ladder_achievements', array('uses' => 'LaddersController@update_ladder_achievements'));
Route::get('/update_achievement_points', array('uses' => 'UsersController@update_achievement_points'));
Route::get('/level_update', array('uses' => 'UsersController@refresh_level'));
Route::get('/users/makeadmin/{id}', array('uses' => 'UsersController@makeAdmin'));
Route::post('users/update_summoner', array('uses' => 'UsersController@update_summoner'));
Route::get('summoner/{region?}/{name?}', 'UsersController@show');
Route::get('summoner/{region?}/{name?}/achievements', 'UsersController@achievements_show');
Route::get('/settings', 'UsersController@edit');
Route::get('/edit_mail', 'UsersController@edit_mail');
Route::get('/timeline_settings', 'UsersController@timeline_settings');
Route::get('/challenges', 'UsersController@challenges');
Route::get('/delete_notifications', 'UsersController@delete_notifications');
Route::get('/refresh_summoner', 'UsersController@refresh_summoner');
Route::get('/quest_finished/{id}', 'UsersController@quest_finished');
Route::get('/verify_double/{region}/{summoner_name}', 'UsersController@verify_double');
Route::get('/lootchest/{notify}', array('uses' => 'UsersController@lootchest'));


// Quests Controller
Route::post('/quests/create_choose_quest', 'QuestsController@create_choose_quest');
Route::post('/quests/create_random_quest', 'QuestsController@create_random_quest');
Route::post('/quests/create_challenge', 'QuestsController@create_challenge');
Route::post('/quests/dailyprogress/{progress}', 'QuestsController@dailyprogress');


Route::post('register', array('before' => 'csrf', function()
{
    return 'You gave a valid CSRF token!';
}));

//Route::post('/quests/check_quest/{quest_id?}', 'QuestsController@check_quest');
Route::post('/quests/check_quest/{quest_id?}', ['before' => 'csrf', 'uses' => 'QuestsController@check_quest']);
Route::get('/quests/reroll_quest/{quest_id?}', 'QuestsController@reroll_quest');
Route::get('/quests/cancel_quest/{quest_id?}', 'QuestsController@cancel_quest');
Route::get('/accept_daily', 'QuestsController@accept_daily');
Route::get('/cancel_challenge', 'QuestsController@cancel_challenge');


// Challenges Controller
Route::post('/finish_challenge', ['before' => 'csrf', 'uses' => 'ChallengesController@finish_challenge']);
Route::post('/challenge/lifetime/{challenge_id}/{progress}', 'UsersController@challengedone');

// Ladders Controller
Route::get('/ladders', 'LaddersController@index');
Route::get('/ladders/top100', 'LaddersController@alltime');
Route::get('/ladders/refresh_ladder', 'LaddersController@refresh_ladder');
Route::get('/ladders/{year?}/{month?}', 'LaddersController@index');


// Arena Controller
Route::get('/arena', 'ArenasController@index');
Route::post('/arena/start_arena', ['before' => 'csrf', 'uses' => 'ArenasController@start_arena']);
Route::post('/arena/start_quest', ['before' => 'csrf', 'uses' => 'ArenasController@start_quest']);
Route::post('/arena/finish_quest', ['before' => 'csrf', 'uses' => 'ArenasController@finish_quest']);
Route::get('/arena/stop_arena', 'ArenasController@stop_arena');


// Notification Controller
Route::get('/notifications/delete_note/{id?}', 'NotificationsController@delete_note');

// Lottery
Route::get('/lottery', 'LotteriesController@lottery');
Route::post('/lottery/enterlottery', ['before' => 'csrf', 'uses' => 'LotteriesController@enterLottery']);


// Shop Controller
Route::get('shop', 'ProductsController@index');
Route::get('shop/buy/{id}', 'ProductsController@buy');

//Route::get('', 'ProductsController@buy_skin');
Route::post('/shop/buy_skin/{id}', ['before' => 'csrf', 'uses' => 'ProductsController@buy_skin']);

//Route::get('shop/buy_betakey', 'ProductsController@buy_betakey');
Route::get('/champion/classes', 'BaseController@classes');
Route::get('shop/buy_betakey/success/{id}', 'ProductsController@show_betakey');
Route::get('shop/offers', 'ProductsController@offers');
Route::get('shop/buy_qp', 'ProductsController@buy_qp');
Route::get('shop/riot_points', 'ProductsController@riot_points');
Route::get('shop/ep_boosts', 'ProductsController@ep_boosts');
Route::get('shop/backgrounds', 'ProductsController@backgrounds');
Route::get('shop/skins', 'ProductsController@skins');
Route::get('shop/loots', 'ProductsController@loots');
Route::get('shop/buy_loot', 'ProductsController@buy_loot');
Route::get('shop/hardware', 'ProductsController@hardware');
Route::get('shop/beta_key', 'ProductsController@betakey');
Route::get('shop/history', 'ProductsController@history');
Route::get('/shop/skin_purchased', 'ProductsController@skin_purchased');
Route::get('shop/quest_slot', 'ProductsController@quest_slot');
Route::get('shop/gold', 'ProductsController@lp');

// PAYPAL
Route::post('payments/success', 'ProductsController@payment_success');
Route::get('payments/success', 'ProductsController@payment_success');

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
Route::get('rules', function()
{
	return View::make('pages.rules');
});

Route::get('supporter', function()
{
	return View::make('pages.donate');
});

Route::get('test', function()
{
	return View::make('pages.test');
});

// App Login
Route::get('/app_login', array('before' => 'api_login', function()
{
	$user = Auth::user();
    return "\n\nHallo $user->summoner_name\n";
}));


// Route group for API versioning
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::get('user', 'ApiController@user');
	Route::get('show/{id}', 'ApiController@show');
	Route::get('champions', 'ApiController@champions');
	Route::get('ladder', 'ApiController@ladder');
	Route::get('top100', 'ApiController@top100');
	Route::get('playerroles', 'ApiController@playerroles');
	Route::get('dashboard', 'ApiController@dashboard');
	Route::post('remote_login', function()
	{
		$remember = Input::get('remember');
		$credentials = array(
			'email' => Input::get('username'), 
			'password' => Input::get('password')
		);

		if (Auth::attempt( $credentials ))
		{
			$user = User::find(Auth::user()->id);
			return Response::json($user);
			//return Redirect::to_action('user@index'); you'd use this if it's not AJAX request
		}else{
			return Response::json('Error logging in', 400);
			/*return Redirect::to_action('home@login')
			-> with_input('only', array('new_username')) 
			-> with('login_errors', true);*/
		}
	});
});

Route::get('/api/users', 'ApiController@users_test');