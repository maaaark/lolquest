<?php

/**
 * ArenaQuest
 *
 * @property-read \ArenaQuestType $questtype
 */
class ArenaQuest extends \Eloquent {
	protected $fillable = [];
	
	public function questtype()
    {
        //return $this->belongsTo('Questtype');
		return $this->hasOne('ArenaQuestType', 'id', 'arena_quest_type_id');
    }
	
}