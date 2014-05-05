<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Custom Filter
|--------------------------------------------------------------------------
|
*/

Route::filter('notifications', function()
{
	if (Auth::check()) {
		$user = User::find(Auth::user()->id);
		$notifications = Notification::where('user_id', '=', $user->id)->where('seen', '=', 0)->get();
		Session::put('notifications_amount', $notifications->count());
		Session::put('notifications', $notifications);
	}
});

Route::filter('friend_ladders', function()
{
	if (Auth::check()) {
		$friend_ladder = array();
		$month = date("n");
		$year = date("Y");
		$friends_ladder = DB::table('ladders')->join('friend_user', 'ladders.user_id', '=', 'friend_user.friend_id')->join('users', 'ladders.user_id', '=', 'users.id')->join('summoners', 'users.id', '=', 'summoners.user_id')->where('ladders.month', '=', $month)->where('ladders.year', '=', $year)->where('friend_user.user_id', '=', Auth::user()->id)->get();
		Session::put('friend_ladder', $friends_ladder);
	}
});


Route::filter('get_daily', function()
{
	if (Auth::check()) {
		$daily_quest = Daily::where('active', '=', 1)->first();
		Session::put('daily_quest', $daily_quest);
	}
});


Route::filter('my_open_quests', function()
{
	if (Auth::check()) {
		$user = User::find(Auth::user()->id);
		$myquests = Quest::where('user_id', '=', $user->id)->where('finished', '=', 0)->get();
		Session::put('my_open_quests', $myquests);
	}
});

Route::filter('my_ladder_rang', function()
{
	if (Auth::check()) {
		$my_ladder_rang = Ladder::where("user_id", "=", Auth::user()->id)->where("month", "=", date("n"))->where("year", "=", date("Y"))->first();
		Session::put('my_ladder_rang', $my_ladder_rang);
	}
});

