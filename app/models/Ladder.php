<?php

/**
 * Ladder
 *
 * @property-read \User $user
 */
class Ladder extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
}