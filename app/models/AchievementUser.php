<?php

class AchievementUser extends \Eloquent {

	protected $table = 'achievement_user';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}