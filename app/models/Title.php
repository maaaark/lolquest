<?php

/**
 * Title
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 */
class Title extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
        return $this->belongsToMany('User');
    }
}