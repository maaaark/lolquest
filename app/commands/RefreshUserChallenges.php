<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshUserChallenges extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:userchallenges';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Challenges';

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
		$users = User::get();
		foreach($users as $user) {
			$challenge = New UserChallenge;
			$challenge->user_id = $user->id;
			$challenge->challenge_id = 1;
			$challenge->save();
		}
    }


}
