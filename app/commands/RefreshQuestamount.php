<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshQuestamount extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:questamount';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Counts quests last 5 Days for champions';

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
		$champions = Champion::all();
		foreach($champions as $champion) {
			$quest_count = ChampionQuest::where("champion_id", "=", $champion->champion_id)->where("quest_date", "=", date("y.m.d"))->first();
			if(!isset($quest_count)) {
				$quest_count = new ChampionQuest;
				$quest_count->quest_date = date("y.m.d");
				$quest_count->champion_id = $champion->champion_id;
				$quest_count->quest_count = 0;
			}
			$quest_count->save();
		}
	}

}
