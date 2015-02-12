<?php

class SummonerStat extends \Eloquent {
	protected $fillable = [];
		
	public function summoner()
    {
        return $this->hasOne('Summoner');
    }
	
}