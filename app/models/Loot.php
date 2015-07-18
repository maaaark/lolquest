<?php

/**
 * Loot
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @property integer $id
 * @property string $loot
 * @property integer $public
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Achievement[] $achievements
 * @method static \Illuminate\Database\Query\Builder|\Loot whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Loot whereLoot($value) 
 * @method static \Illuminate\Database\Query\Builder|\Loot wherePublic($value) 
 * @method static \Illuminate\Database\Query\Builder|\Loot whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Loot whereUpdatedAt($value) 
 */
class Loot extends \Eloquent {
	protected $fillable = [];
	
	public function users()
    {
        return $this->belongsToMany('User');
    }
}