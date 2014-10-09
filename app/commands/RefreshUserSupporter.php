<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshUserSupporter extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:usersupporter';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Supporters';

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
		//echo "\nRefreshing donators ...\n";
		$betakeys=Betakey::where('key', 'LIKE', 'supporter_%')->get(); 
		foreach($betakeys as $key) {
			if($key->user_id != 0){
				$user = User::find($key->user_id);
				if($user){
				if($user->donator == 0){
					$user->donator = 1;
					$user->save();
				}}
			}
		}
	}


}
