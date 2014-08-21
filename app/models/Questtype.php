<?php

/**
 * Questtype
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Quest[] $quests
 * @property-read \Playerrole $playerrole
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $premium
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $exp
 * @property integer $qp
 * @property integer $playerrole_id
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype wherePremium($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype whereQp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Questtype wherePlayerroleId($value) 
 */
class Questtype extends \Eloquent {

	public function quests()
    {
        return $this->hasMany('Quest');
    }
	
	public function playerrole()
    {
        return $this->belongsTo('Playerrole');
    }
	
	protected $fillable = [];
}