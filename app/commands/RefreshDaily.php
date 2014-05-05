<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshDaily extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:daily';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generates a new daily quest';

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
		echo "\nRefreshing daily Quest ...\n";
		$old_daily = Daily::where('active', '=', 1)->first();
		$old_daily->active = 0;
		$old_daily->save();
		
		$daily = new Daily;
		$champion = Champion::orderBy(DB::raw('RAND()'))->first();
		$questtype = Questtype::orderBy(DB::raw('RAND()'))->first();
		$daily->champion_id = $champion->id;
		$daily->type_id = $questtype->id;
		$daily->active = 1;
		
		$daily->save();
	}


}