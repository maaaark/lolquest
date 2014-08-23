<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshTeams extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:teams';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh the team ladder';

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
		$teams = Team::all();
		foreach($teams as $team) {
			if($team->members->count() > 0) {
				$team->average_exp = $team->exp / $team->members->count();
				$team->save();
			}
		}
		
		$teams = Team::orderBy("average_exp", "DESC")->get();
		$i = 1;
		foreach($teams as $team) {
			if($team->members->count() >= 3) {
				$team->rank = $i;
			} else {
				$team->rank = 0;
			}
			$team->save();
			$i++;
		}
	}


}
