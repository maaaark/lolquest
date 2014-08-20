<?php

/**
 * Summoner
 *
 * @property-read \User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Game[] $games
 */
class Summoner extends \Eloquent {

	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function games()
    {
        return $this->hasMany('Game');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}