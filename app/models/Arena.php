<?php

/**
 * Arena
 *
 * @property-read \User $user
 */
class Arena extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}