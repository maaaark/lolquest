<?php

/**
 * ChampionQuest
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $quest_date
 * @property integer $champion_id
 * @property integer $quest_count
 * @method static \Illuminate\Database\Query\Builder|\ChampionQuest whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ChampionQuest whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ChampionQuest whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\ChampionQuest whereQuestDate($value) 
 * @method static \Illuminate\Database\Query\Builder|\ChampionQuest whereChampionId($value) 
 * @method static \Illuminate\Database\Query\Builder|\ChampionQuest whereQuestCount($value) 
 */
class ChampionQuest extends \Eloquent {
	protected $fillable = [];
}