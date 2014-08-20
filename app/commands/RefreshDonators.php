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
		
		$users = User::where("donator", ">", 0)->get();
		foreach($users as $user) {
			$has_donator_achievement = 0;
			
			
			// Donator Level 1
			if($user->donator >= 1) {
				// check achievement
				if($user->hasAchievement(55) == false) {
					// Attach Erfolg
					$user->achievements()->attach(55);
					//echo "\nAdding Achievement to User ".$user->summoner_name."\n";
					$achiv = Achievement::find(55);
					$user->notify(1, trans("achievements.receive").'<a href="/summoner/'.$user->region.'/'.$user->summoner_name.'/achievements"> '.$achiv->name.'</a>');
					$user->timeline("new_achievement",0, 55, 0, 0, 0, 0);
					$user->achievement_points += $achiv->points;
					$user->save();
				}
				
				// check title
				$title = UserTitle::where("user_id", "=", $user->id)->where("title_id", "=", 3)->first();
				if(!$title) {
					$new_title = new UserTitle;
					$new_title->user_id = $user->id;
					$new_title->title_id = 3;
					$new_title->save();
					//echo "\nAdding Title 'Donator' to User ".$user->summoner_name."\n";
					
					$user->timeline("new_title",0, 0, 0, 0, 0, 0, $new_title->title_id);
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
					//echo "\nAdding Title 'the gracious' to User ".$user->summoner_name."\n";
					
					$user->timeline("new_title",0, 0, 0, 0, 0, 0, $new_title->title_id);
				}
			}
			
			
			
		}
	}


}
