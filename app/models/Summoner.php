<?php

/**
 * Summoner
 *
 * @property-read \User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Game[] $games
 * @property integer $id
 * @property integer $user_id
 * @property integer $summonerid
 * @property string $name
 * @property integer $profileIconId
 * @property integer $summonerLevel
 * @property integer $revisionDate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $region
 * @property integer $accountId
 * @property string $platformId
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereSummonerid($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereProfileIconId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereSummonerLevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereRevisionDate($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereRegion($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner whereAccountId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Summoner wherePlatformId($value) 
 */
class Summoner extends \Eloquent {

	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function games()
    {
        return $this->hasMany('Game');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}