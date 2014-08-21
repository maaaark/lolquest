<?php

/**
 * Level
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\User[] $users
 * @property integer $id
 * @property integer $exp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $exp_level
 * @method static \Illuminate\Database\Query\Builder|\Level whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Level whereExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Level whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Level whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Level whereExpLevel($value) 
 */
class Level extends \Eloquent {
	
		public function users()
    {
        return $this->hasMany('User');
    }
	
	
	protected $fillable = [];
}