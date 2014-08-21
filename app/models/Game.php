<?php

/**
 * Game
 *
 * @property-read \Summoner $summoner
 * @property-read \Champion $champion
 * @property-read \Illuminate\Database\Eloquent\Collection|\Item[] $items
 * @property integer $id
 * @property integer $summoner_id
 * @property integer $totalDamageDealtToChampions
 * @property integer $goldEarned
 * @property integer $item0
 * @property integer $item1
 * @property integer $item2
 * @property integer $item3
 * @property integer $item4
 * @property integer $item5
 * @property integer $item6
 * @property integer $wardPlaced
 * @property integer $totalDamageTaken
 * @property integer $trueDamageDealtPlayer
 * @property integer $physicalDamageDealtPlayer
 * @property integer $trueDamageDealtToChampions
 * @property integer $totalUnitsHealed
 * @property integer $largestCriticalStrike
 * @property integer $level
 * @property integer $neutralMinionsKilledYourJungle
 * @property integer $magicDamageDealtToChampions
 * @property integer $magicDamageDealtPlayer
 * @property integer $neutralMinionsKilledEnemyJungle
 * @property integer $assists
 * @property integer $magicDamageTaken
 * @property integer $numDeaths
 * @property integer $totalTimeCrowdControlDealt
 * @property integer $largestMultiKill
 * @property integer $physicalDamageTaken
 * @property boolean $win
 * @property integer $team
 * @property integer $totalDamageDealt
 * @property integer $totalHeal
 * @property integer $minionsKilled
 * @property integer $timePlayed
 * @property integer $physicalDamageDealtToChampions
 * @property integer $championsKilled
 * @property integer $trueDamageTaken
 * @property integer $neutralMinionsKilled
 * @property integer $goldSpent
 * @property integer $gameId
 * @property integer $ipEarned
 * @property integer $spell1
 * @property integer $spell2
 * @property integer $teamId
 * @property string $gameMode
 * @property integer $mapId
 * @property boolean $invalid
 * @property string $subType
 * @property integer $createDate
 * @property integer $championId
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $gameType
 * @property integer $wardKilled
 * @property integer $turretsKilled
 * @property integer $killingSprees
 * @property integer $queueId
 * @property float $gold_per_min
 * @property float $exp_per_min
 * @property float $cs_per_min
 * @property integer $firstBloodKill
 * @property integer $firstBloodAssist
 * @property integer $doubleKills
 * @property integer $tripleKills
 * @property integer $quadraKills
 * @property integer $pentaKills
 * @property integer $cc_dealt
 * @property integer $time_dead
 * @method static \Illuminate\Database\Query\Builder|\Game whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereSummonerId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTotalDamageDealtToChampions($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereGoldEarned($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem0($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem1($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem2($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem3($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem4($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem5($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereItem6($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereWardPlaced($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTotalDamageTaken($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTrueDamageDealtPlayer($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game wherePhysicalDamageDealtPlayer($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTrueDamageDealtToChampions($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTotalUnitsHealed($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereLargestCriticalStrike($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereLevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereNeutralMinionsKilledYourJungle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereMagicDamageDealtToChampions($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereMagicDamageDealtPlayer($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereNeutralMinionsKilledEnemyJungle($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereAssists($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereMagicDamageTaken($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereNumDeaths($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTotalTimeCrowdControlDealt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereLargestMultiKill($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game wherePhysicalDamageTaken($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereWin($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTeam($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTotalDamageDealt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTotalHeal($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereMinionsKilled($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTimePlayed($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game wherePhysicalDamageDealtToChampions($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereChampionsKilled($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTrueDamageTaken($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereNeutralMinionsKilled($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereGoldSpent($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereGameId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereIpEarned($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereSpell1($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereSpell2($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTeamId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereGameMode($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereMapId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereInvalid($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereSubType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereCreateDate($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereChampionId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereGameType($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereWardKilled($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTurretsKilled($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereKillingSprees($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereQueueId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereGoldPerMin($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereExpPerMin($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereCsPerMin($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereFirstBloodKill($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereFirstBloodAssist($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereDoubleKills($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTripleKills($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereQuadraKills($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game wherePentaKills($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereCcDealt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Game whereTimeDead($value) 
 */
class Game extends \Eloquent {
	
	public function summoner()
    {
        return $this->belongsTo('Summoner');
    }
	
	public function champion()
    {
        return $this->hasOne('Champion', 'champion_id', 'championId');
    }
	
	public function items()
    {
		return $this->belongsToMany('Item');
    }

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}