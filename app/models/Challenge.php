<?php

/**
 * Challenge
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Timeline[] $timelines
 */
class Challenge extends \Eloquent {
	protected $fillable = [];
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
	
}