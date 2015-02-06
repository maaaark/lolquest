<?php

class Dailyprogess extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function addWin($user) {
		$progress = Dailyprogess::where('user_id', '=', $user->id)->first();
		if($progress->wins < 3) {
			$progress->wins = $progress->wins +1;
			$progress->save();
		}
	}
	
	public function addQuestCompleted($user, $game) {
		$progress = Dailyprogess::where('user_id', '=', $user->id)->first();
		if($progress->quests_completed < 5) {
			$progress->quests_completed = $progress->quests_completed +1;
			$progress->save();
		}
	}
	
	public function addTopGame($user) {
		$progress = Dailyprogess::where('user_id', '=', $user->id)->first();
		if($progress->top_games < 2) {
			$progress->top_games = $progress->top_games +1;
			$progress->save();
		}
	}
	
	public function addJungleGame($user) {
		$progress = Dailyprogess::where('user_id', '=', $user->id)->first();
		if($progress->jungle_games < 2) {
			$progress->jungle_games = $progress->jungle_games +1;
			$progress->save();
		}
	}
	
	public function addMidGame($user) {
		$progress = Dailyprogess::where('user_id', '=', $user->id)->first();
		if($progress->mid_games < 2) {
			$progress->mid_games = $progress->mid_games +1;
			$progress->save();
		}
	}
	
	public function addBotGame($user) {
		$progress = Dailyprogess::where('user_id', '=', $user->id)->first();
		if($progress->bot_games < 2) {
			$progress->bot_games = $progress->bot_games +1;
			$progress->save();
		}
	}
}