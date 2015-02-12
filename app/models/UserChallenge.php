<?php

class UserChallenge extends \Eloquent {
	protected $fillable = [];
	
	protected $table = 'user_challenge';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];
	
}