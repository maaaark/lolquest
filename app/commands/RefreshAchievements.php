<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshAchievements extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:achievements';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh ladder achievements from User.';

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
		//
		
		$ladder = Ladder::where("month", "<", 9)->get();
		
		
		
	    foreach($ladder as $row) {
		if( $row > 6 ) {
			$user = User::find($row->user_id);
			$i = $row->rang;
			if ($i == 1) {
				$user->achievements()->attach(49);
				$user->achievements->find(49)->pivot->created_at = $row->created_at;
				$user->achievements->find(49)->pivot->save();
				$achievement = Achievement::where('id', '=', 49)->first();
				$user->notify(1, trans("achievements.receive").$achievement->name);
				$user->achievement_points += $achievement->points;
				$user->save();
			} elseif ($i == 2) {
				$user->achievements()->attach(50);
				$user->achievements->find(50)->pivot->created_at = $row->created_at;
				$user->achievements->find(50)->pivot->save();
				$achievement = Achievement::where('id', '=', 50)->first();
				$user->notify(1, trans("achievements.receive").$achievement->name);
				$user->achievement_points += $achievement->points;
				$user->save();
			} elseif ($i ==3) {
				$user->achievements()->attach(51);
				$user->achievements->find(51)->pivot->created_at = $row->created_at;
				$user->achievements->find(51)->pivot->save();
				$achievement = Achievement::where('id', '=', 51)->first();
				$user->notify(1, trans("achievements.receive").$achievement->name);
				$user->achievement_points += $achievement->points;
				$user->save();
			} elseif ($i <= 10) {
				$user->achievements()->attach(52);
				$user->achievements->find(52)->pivot->created_at = $row->created_at;
				$user->achievements->find(52)->pivot->save();
				$achievement = Achievement::where('id', '=', 52)->first();
				$user->notify(1, trans("achievements.receive").$achievement->name);
				$user->achievement_points += $achievement->points;
				$user->save();
			} elseif ($i <= 50) {
				$user->achievements()->attach(53);
				$user->achievements->find(53)->pivot->created_at = $row->created_at;
				$user->achievements->find(53)->pivot->save();
				$achievement = Achievement::where('id', '=', 53)->first();
				$user->notify(1, trans("achievements.receive").$achievement->name);
				$user->achievement_points += $achievement->points;
				$user->save();
			} elseif ($i <= 100) {
				$user->achievements()->attach(54);
				$user->achievements->find(54)->pivot->created_at = $row->created_at;
				$user->achievements->find(54)->pivot->save();
				$achievement = Achievement::where('id', '=', 54)->first();
				$user->notify(1, trans("achievements.receive").$achievement->name);
				$user->achievement_points += $achievement->points;
				$user->save();
			}
		}			
		}
	}
}
