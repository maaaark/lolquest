<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshDonators extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:donators';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refreshing Donators';

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
		echo "\nRefreshing donators ...\n";
		
		$users = User::where("donator", ">", 0)->get();
		foreach($users as $user) {
			$has_donator_achievement = 0;
			
			
			// Donator Level 1
			if($user->donator >= 1) {
				// check achievement
				if($user->hasAchievement(55) == false) {
					// Attach Erfolg
					$user->achievements()->attach(55);
					echo "\nAdding Achievement to User ".$user->summoner_name."\n";
				}
				
				// check title
				$title = UserTitle::where("user_id", "=", $user->id)->where("title_id", "=", 3)->first();
				if(!$title) {
					$new_title = new UserTitle;
					$new_title->user_id = $user->id;
					$new_title->title_id = 3;
					$new_title->save();
					echo "\nAdding Title 'Donator' to User ".$user->summoner_name."\n";
				}
				
				// Reset vars
				$has_donator_achievement = 0;
			}
			
			
			// Donator Level 2
			if($user->donator >= 2) {
				// check title
				$title = UserTitle::where("user_id", "=", $user->id)->where("title_id", "=", 1)->first();
				if(!$title) {
					$new_title = new UserTitle;
					$new_title->user_id = $user->id;
					$new_title->title_id = 1;
					$new_title->save();
					echo "\nAdding Title 'the gracious' to User ".$user->summoner_name."\n";
				}
			}
			
			
			
		}
	}


}
