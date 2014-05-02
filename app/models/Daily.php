<?php

class Daily extends \Eloquent {
	protected $fillable = [];
	
	public function champion()
    {
        return $this->belongsTo('Champion');
    }
	
	public function questtype()
    {
		return $this->hasOne('Questtype', 'id', 'type_id');
    }
}