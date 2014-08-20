<?php

/**
 * Level
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 */
class Level extends \Eloquent {
	
		public function users()
    {
        return $this->hasMany('User');
    }
	
	
	protected $fillable = [];
}