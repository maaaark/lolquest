<?php

/**
 * Challenge
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Timeline[] $timelines
 * @property integer $id
 * @property integer $challenge_role
 * @property integer $step
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Challenge whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Challenge whereChallengeRole($value) 
 * @method static \Illuminate\Database\Query\Builder|\Challenge whereStep($value) 
 * @method static \Illuminate\Database\Query\Builder|\Challenge whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Challenge whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Challenge whereUpdatedAt($value) 
 */
class Challenge extends \Eloquent {
	protected $fillable = [];
	
	public function timelines()
    {
        return $this->hasMany('Timeline');
    }
	
	public function users()
    {
        return $this->belongsToMany('User');
    }
	
	public function first_challenges()
    {
		$users = User::get();
		foreach($users as $user) {
			$user->challenges()->attach(1);
		}
    }
	
	
	
}