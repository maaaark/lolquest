<?php

/**
 * Game
 *
 * @property-read \Summoner $summoner
 * @property-read \Champion $champion
 * @property-read \Illuminate\Database\Eloquent\Collection|\Item[] $items
 */
class Game extends \Eloquent {
	
	public function summoner()
    {
        return $this->belongsTo('Summoner');
    }
	
	public function champion()
    {
        return $this->hasOne('Champion', 'champion_id', 'championId');
    }
	
	public function items()
    {
		return $this->belongsToMany('Item');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}