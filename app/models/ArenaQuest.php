<?php

/**
 * ArenaQuest
 *
 * @property-read \ArenaQuestType $questtype
 * @property integer $id
 * @property integer $user_id
 * @property integer $champion_id
 * @property integer $arena_id
 * @property integer $arena_quest_type_id
 * @property boolean $finished
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereChampionId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereArenaId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereArenaQuestTypeId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereFinished($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ArenaQuest whereUpdatedAt($value) 
 */
class ArenaQuest extends \Eloquent {
	protected $fillable = [];
	
	public function questtype()
    {
        //return $this->belongsTo('Questtype');
		return $this->hasOne('ArenaQuestType', 'id', 'arena_quest_type_id');
    }
	
}