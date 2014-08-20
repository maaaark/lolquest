<?php

/**
 * Daily
 *
 * @property-read \Champion $champion
 * @property-read \Questtype $questtype
 */
class Daily extends \Eloquent {
	protected $fillable = [];
	
	public function champion()
    {
        return $this->hasOne('Champion', 'champion_id', 'champion_id');
    }
	
	public function questtype()
    {
		return $this->hasOne('Questtype', 'id', 'type_id');
    }
}