<?php

/**
 * Playerrole
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Questtype[] $questtypes
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Playerrole whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Playerrole whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Playerrole whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Playerrole whereUpdatedAt($value) 
 */
class Playerrole extends \Eloquent {

	public function questtypes()
    {
        return $this->hasMany('Questtype');
    }
	
	protected $fillable = [];
}