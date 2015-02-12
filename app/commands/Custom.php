<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Custom extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'run:custom';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Custom Function';

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
			
		$users = User::all();
		foreach($users as $user) {
			$daily = new Dailyprogess;
			$daily->user_id = $user->id;
			$daily->save();
		}
		echo "Daily Progress für alle User angelegt \n"
	}
}
