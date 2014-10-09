<?php

class AchievementTeam extends \Eloquent {
	
	protected $table = 'achievement_team';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
}