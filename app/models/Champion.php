<?php

class Champion extends \Eloquent {
	
	public function quests()
    {
        //return $this->hasMany('Quest');
		return $this->hasMany('Quest', 'champion_id', 'champion_id');
    }
	
	public function daylies()
    {
        return $this->hasMany('Daily');
    }
	
	public function skins()
    {
        return $this->hasMany('Skin');
    }
	
	public function pickrate($games_amount) {
		DB::disableQueryLog();
		$champion_games = Game::where("championId","=", $this->champion_id)->count();
		$pickrate = (100/$games_amount) * $champion_games;
		return round($pickrate,2);
	}
	
	public function winrate() {
		DB::disableQueryLog();
		$champion_wins = Game::where("championId","=", $this->champion_id)->where("win","=", 1)->count();
		$champion_games = Game::where("championId","=", $this->champion_id)->count();
		if($champion_games <= 0) {
			$winrate = 0;
		} else {
			$winrate = (100/$champion_games) * $champion_wins;
		}
		return round($winrate,2);
	}
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}