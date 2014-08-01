<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshChampions extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:champions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Champion data from API';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$api_key = Config::get('api.key');
		$summoner_data = "https://global.api.pvp.net/api/lol/static-data/euw/v1.2/champion?dataById=true&champData=info,stats&api_key=".$api_key;
		$json = @file_get_contents($summoner_data);
		if($json === FALSE) {
			return View::make('login');
		} else {
			$obj = json_decode($json, true);
			
			foreach($obj["data"] as $champion) {
				$recent_champion = Champion::where('champion_id', '=', $champion["id"])->first();
				if(!isset($recent_champion)) {
					$new_champion = new Champion;
					$new_champion->name = $champion["name"];
					$new_champion->title = $champion["title"];
					$new_champion->champion_id = $champion["id"];
					$new_champion->key = $champion["key"];
					
					$new_champion->attackrange = $champion["stats"]["attackrange"];
					$new_champion->mpperlevel = $champion["stats"]["mpperlevel"];
					$new_champion->mp = $champion["stats"]["mp"];
					$new_champion->attackdamage = $champion["stats"]["attackdamage"];
					$new_champion->hp = $champion["stats"]["hp"];
					$new_champion->hpperlevel = $champion["stats"]["hpperlevel"];
					$new_champion->attackdamageperlevel = $champion["stats"]["attackdamageperlevel"];
					$new_champion->armor = $champion["stats"]["armor"];
					$new_champion->mpregenperlevel = $champion["stats"]["mpregenperlevel"];
					$new_champion->hpregen = $champion["stats"]["hpregen"];
					$new_champion->critperlevel = $champion["stats"]["critperlevel"];
					$new_champion->spellblockperlevel = $champion["stats"]["spellblockperlevel"];
					$new_champion->mpregen = $champion["stats"]["mpregen"];
					$new_champion->attackspeedperlevel = $champion["stats"]["attackspeedperlevel"];
					$new_champion->spellblock = $champion["stats"]["spellblock"];
					$new_champion->movespeed = $champion["stats"]["movespeed"];
					$new_champion->attackspeedoffset = $champion["stats"]["attackspeedoffset"];
					$new_champion->crit = $champion["stats"]["crit"];
					$new_champion->hpregenperlevel = $champion["stats"]["hpregenperlevel"];
					$new_champion->armorperlevel = $champion["stats"]["armorperlevel"];
					
					
					$new_champion->save();
					echo "Saved Champion".$champion["name"]."\n";
				}
				unset($recent_champion);
			}
		}
		
		//echo "\n\nChampions refreshed\n\n";
	}


}
