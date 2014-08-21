<?php

/**
 * ArenaQuestType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ArenaQuest[] $arena_quests
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $qp
 * @property integer $exp
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereDescription($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereQp($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereExp($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuestType whereUpdatedAt($value) 
 */
class ArenaQuestType extends \Eloquent {
	protected $fillable = [];	
	
	public function arena_quests()
    {
        return $this->hasMany('ArenaQuest');
    }
	
}