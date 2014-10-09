<?php

/**
 * Team
 *
 * @property-read \User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $members
 * @property integer $id
 * @property string $name
 * @property integer $exp
 * @property integer $team_level_id
 * @property string $description
 * @property string $website
 * @property string $logo
 * @property boolean $public
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $clean_name
 * @property integer $user_id
 * @property string $region
 * @property integer $rank
 * @property string $secret
 * @property float $average_exp
 * @property integer $quests
 * @method static \Illuminate\Database\Query\Builder|\Team whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereTeamLevelId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereWebsite($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereLogo($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team wherePublic($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereCleanName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereRegion($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereRank($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereSecret($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereAverageExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Team whereQuests($value) 
 */
class Team extends \Eloquent {
	protected $fillable = [];
	
	public static $rules = array(
		'teamname'=>'required|min:3',
		'region'=>'required|alpha|min:2',
		'website'=>'url'
	);
	
	public function user()
    {
        return $this->belongsTo('User');
    }
	
	public function achievements()
    {
		return $this->belongsToMany('Achievement')->withTimestamps();
    }
	
	public function members()
    {
        return $this->hasMany('User');
    }
	
}