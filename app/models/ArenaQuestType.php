<?php

/**
 * ArenaQuestType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\ArenaQuest[] $arena_quests
 */
class ArenaQuestType extends \Eloquent {
	protected $fillable = [];	
	
	public function arena_quests()
    {
        return $this->hasMany('ArenaQuest');
    }
	
}