<?php

/**
 * Title
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @property integer $id
 * @property string $title
 * @property integer $public
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Achievement[] $achievements
 * @method static \Illuminate\Database\Query\Builder|\Title whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Title whereTitle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Title wherePublic($value) 
 * @method static \Illuminate\Database\Query\Builder|\Title whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Title whereUpdatedAt($value) 
 */
class Title extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
        return $this->belongsToMany('User');
    }
	
	public function achievements()
    {
		return $this->hasMany('Achievement');
    }
	
}