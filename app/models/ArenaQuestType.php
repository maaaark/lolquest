<?php

class ArenaQuestType extends \Eloquent {
	protected $fillable = [];	
	
	public function arena_quests()
    {
        return $this->hasMany('ArenaQuest');
    }
	
}