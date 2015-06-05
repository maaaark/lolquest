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
	
	public function addQuestCompleted($user) {
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

    public function addFighterGame($user) {
        $progress = Dailyprogess::where('user_id', '=', $user->id)->first();
        if($progress->fighter_games < 2) {
            $progress->fighter_games = $progress->fighter_games +1;
            $progress->save();
        }
    }

    public function addTankGame($user) {
        $progress = Dailyprogess::where('user_id', '=', $user->id)->first();
        if($progress->tank_games < 2) {
            $progress->tank_games = $progress->tank_games +1;
            $progress->save();
        }
    }

    public function addAssassinGame($user) {
        $progress = Dailyprogess::where('user_id', '=', $user->id)->first();
        if($progress->assassin_games < 2) {
            $progress->assassin_games = $progress->assassin_games +1;
            $progress->save();
        }
    }
    public function addMarksmanGame($user) {
        $progress = Dailyprogess::where('user_id', '=', $user->id)->first();
        if($progress->marksman_games < 2) {
            $progress->marksman_games = $progress->marksman_games +1;
            $progress->save();
        }
    }
    public function addSupportGame($user) {
        $progress = Dailyprogess::where('user_id', '=', $user->id)->first();
        if($progress->support_games < 2) {
            $progress->support_games = $progress->support_games +1;
            $progress->save();
        }
    }
    public function addMageGame($user) {
        $progress = Dailyprogess::where('user_id', '=', $user->id)->first();
        if($progress->mage_games < 2) {
            $progress->mage_games = $progress->mage_games +1;
            $progress->save();
        }
    }
}