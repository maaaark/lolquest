<?php

class TimelinesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()) {
			$timeline_friends_only = Auth::user()->timeline_friends_only;
		} else  {
			$timeline_friends_only = 0;
		}
		
		$friend_ids = array();
		
		if($timeline_friends_only == 0) {
			$timelines = Timeline::orderBy('id', 'desc')->paginate(25);
			return View::make('timelines.index', compact('timelines', 'friend_ids'));
		} else {
			$user = User::find(Auth::user()->id);
			$friends = FriendUser::where("user_id", "=", $user->id)->where("validate", "=", 1)->get();
			
			foreach($friends as $friend) {
				$friend_ids[] = $friend->friend_id;
			}
			
			$timelines = Timeline::orderBy('id', 'desc')->whereIn('user_id', $friend_ids)->paginate(25);
			return View::make('timelines.index', compact('timelines', 'friend_ids'));	
		}
		
	}



}
