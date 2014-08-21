<?php

/**
 * Champion
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Quest[] $quests
 * @property-read \Illuminate\Database\Eloquent\Collection|\Daily[] $daylies
 * @property-read \Illuminate\Database\Eloquent\Collection|\Skin[] $skins
 * @property integer $id
 * @property string $name
 * @property integer $champion_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $key
 * @property float $attackrange
 * @property float $mpperlevel
 * @property float $mp
 * @property float $attackdamage
 * @property float $hp
 * @property float $hpperlevel
 * @property float $attackdamageperlevel
 * @property float $armor
 * @property float $mpregenperlevel
 * @property float $hpregen
 * @property float $critperlevel
 * @property float $spellblockperlevel
 * @property float $mpregen
 * @property float $attackspeedperlevel
 * @property float $spellblock
 * @property float $movespeed
 * @property float $attackspeedoffset
 * @property float $crit
 * @property float $hpregenperlevel
 * @property float $armorperlevel
 * @property string $title
 * @method static \Illuminate\Database\Query\Builder|\Champion whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereName($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereChampionId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereKey($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereAttackrange($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereMpperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereMp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereAttackdamage($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereHp($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereHpperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereAttackdamageperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereArmor($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereMpregenperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereHpregen($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereCritperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereSpellblockperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereMpregen($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereAttackspeedperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereSpellblock($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereMovespeed($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereAttackspeedoffset($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereCrit($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereHpregenperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereArmorperlevel($value) 
 * @method static \Illuminate\Database\Query\Builder|\Champion whereTitle($value) 
 */
class Champion extends \Eloquent {
	
	public function quests()
    {
		return $this->hasMany('Quest', 'champion_id', 'champion_id');
    }
	
	public function daylies()
    {
        return $this->hasMany('Daily');
    }
	
	public function skins()
    {
        return $this->hasMany('Skin');
    }
	
	public function pickrate($games_amount) {
		DB::connection()->disableQueryLog();
		$champion_games = Game::where("championId","=", $this->champion_id)->count();
		$pickrate = (100/$games_amount) * $champion_games;
		return round($pickrate,2);
	}
	
	public function winrate() {
		DB::connection()->disableQueryLog();
		$champion_wins = Game::where("championId","=", $this->champion_id)->where("win","=", 1)->count();
		$champion_games = Game::where("championId","=", $this->champion_id)->count();
		if($champion_games <= 0) {
			$winrate = 0;
		} else {
			$winrate = (100/$champion_games) * $champion_wins;
		}
		return round($winrate,2);
	}
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}