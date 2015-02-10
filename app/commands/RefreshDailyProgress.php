<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshDailyProgress extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:dailyprogress';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Resets daily progress';

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
			
		$dailyprogress = Dailyprogess::all();
		foreach($dailyprogress as $daily) {
			$daily->games = 0;
			$daily->wins = 0;
			$daily->quests_completed = 0;
			$daily->top_games = 0;
			$daily->jungle_games = 0;
			$daily->mid_games = 0;
			$daily->bot_games = 0;
			$daily->save();
		}
	}
}
