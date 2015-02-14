<?php

class ChallengeUser extends \Eloquent {

	protected $table = 'challenge_user';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}