<?php

class Skin extends \Eloquent {
	protected $fillable = [];
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function champion()
    {
        return $this->belongsTo('Champion', 'champion_id', 'champion_id');;
    }
}