<?php

/**
 * Friend
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\user[] $users
 */
class Friend extends \Eloquent {

	public function users()
    {
        return $this->belongsToMany('user');
    }
	
	protected $fillable = [];
}