<?php

/**
 * UserTitle
 *
 * @property-read \User $user
 * @property-read \Title $title
 */
class UserTitle extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function title()
    {
        return $this->belongsTo('Title');
    }
}