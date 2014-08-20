<?php

/**
 * Playerrole
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Questtype[] $questtypes
 */
class Playerrole extends \Eloquent {

	public function questtypes()
    {
        return $this->hasMany('Questtype');
    }
	
	protected $fillable = [];
}