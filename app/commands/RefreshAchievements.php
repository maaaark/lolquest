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
		$year = date("Y");
		$month = date("m");
		if ($month == 1) {
			$month = 12;
			$year -= 1;
		} else {
			$month -= 1;
		}
		$ladder = Ladder::where("month", "=", $month)->where('year', '=', $year)->get();
		$model = new AchievementUser;
		$model->setTable("achievement_user");
		
	    foreach($ladder as $row) {
			$user = User::find($row->user_id);
			$i = $row->rang;
			if ($user) {
				if ($i == 1) {				
					$user->achievements()->attach(49);
					$user_achievement = $model->where("user_id", "=", $row->user_id)->where("achievement_id", "=", 49)->orderBy('id', 'DESC')->first();
					$user_achievement->created_at = $row->created_at;
					$user_achievement->save();
					$achievement = Achievement::where('id', '=', 49)->first();
					$user->notify(1, trans("achievements.receive").$achievement->name);
					$user->achievement_points += $achievement->points;
					$user->save();
				} elseif ($i == 2) {
					$user->achievements()->attach(50);
					$user_achievement = $model->where("user_id", "=", $row->user_id)->where("achievement_id", "=", 50)->orderBy('id', 'DESC')->first();
					$user_achievement->created_at = $row->created_at;
					$user_achievement->save();
					$achievement = Achievement::where('id', '=', 50)->first();
					$user->notify(1, trans("achievements.receive").$achievement->name);
					$user->achievement_points += $achievement->points;
					$user->save();
				} elseif ($i ==3) {
					$user->achievements()->attach(51);
					$user_achievement = $model->where("user_id", "=", $row->user_id)->where("achievement_id", "=", 51)->orderBy('id', 'DESC')->first();
					$user_achievement->created_at = $row->created_at;
					$user_achievement->save();
					$achievement = Achievement::where('id', '=', 51)->first();
					$user->notify(1, trans("achievements.receive").$achievement->name);
					$user->achievement_points += $achievement->points;
					$user->save();
				} elseif ($i <= 10) {
					$user->achievements()->attach(52);
					$user_achievement = $model->where("user_id", "=", $row->user_id)->where("achievement_id", "=", 52)->orderBy('id', 'DESC')->first();
					$user_achievement->created_at = $row->created_at;
					$user_achievement->save();
					$achievement = Achievement::where('id', '=', 52)->first();
					$user->notify(1, trans("achievements.receive").$achievement->name);
					$user->achievement_points += $achievement->points;
					$user->save();
				} elseif ($i <= 50) {
					$user->achievements()->attach(53);
					$user_achievement = $model->where("user_id", "=", $row->user_id)->where("achievement_id", "=", 53)->orderBy('id', 'DESC')->first();
					$user_achievement->created_at = $row->created_at;
					$user_achievement->save();
					$achievement = Achievement::where('id', '=', 53)->first();
					$user->notify(1, trans("achievements.receive").$achievement->name);
					$user->achievement_points += $achievement->points;
					$user->save();
				} elseif ($i <= 100) {
					$user->achievements()->attach(54);
					$user_achievement = $model->where("user_id", "=", $row->user_id)->where("achievement_id", "=", 54)->orderBy('id', 'DESC')->first();
					$user_achievement->created_at = $row->created_at;
					$user_achievement->save();
					$achievement = Achievement::where('id', '=', 54)->first();
					$user->notify(1, trans("achievements.receive").$achievement->name);
					$user->achievement_points += $achievement->points;
					$user->save();
				}
			}
		}			
		
	}
}