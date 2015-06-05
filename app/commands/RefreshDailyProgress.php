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
			$daily->claimed_wins = 0;
			$daily->claimed_quests = 0;
			$daily->claimed_top = 0;
			$daily->claimed_jungle = 0;
			$daily->claimed_mid = 0;
			$daily->claimed_bot = 0;

            $daily->fighter_games = 0;
            $daily->assassin_games = 0;
            $daily->mage_games = 0;
            $daily->marksman_games = 0;
            $daily->tank_games = 0;
            $daily->support_games = 0;

            $daily->claimed_fighter = 0;
            $daily->claimed_assassin = 0;
            $daily->claimed_mage = 0;
            $daily->claimed_marksman = 0;
            $daily->claimed_tank = 0;
            $daily->claimed_support = 0;

			$daily->save();
		}

        $users = User::all();
        foreach($users as $user) {
            $random_dailies = range(1,12);
            shuffle($random_dailies);
            $random_dailies = array_slice($random_dailies,2,3);
            $random_dailies = serialize($random_dailies);
            $user->daily_quests = $random_dailies;
            $user->save();
        }
	}
}
