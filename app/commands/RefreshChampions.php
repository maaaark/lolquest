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
		$summoner_data = "https://prod.api.pvp.net/api/lol/static-data/euw/v1.2/champion?locale=de_DE&dataById=true&champData=info,partype&api_key=".$api_key;
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
					$new_champion->champion_id = $champion["id"];
					$new_champion->save();
					echo "Saved Champion".$champion["name"]."<br/>";
				}
				unset($recent_champion);
			}
		}
		
		echo "\n\nChampions refreshed\n\n";
	}


}
