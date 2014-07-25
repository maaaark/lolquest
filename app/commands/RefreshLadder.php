<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshLadder extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:ladder';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh the current ladder';

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
		$year = date("Y");
		$month = date("m");
		$i = 1;
		$x = 1;
			
		$ladder = DB::select(DB::raw('
			SELECT user_id, updated_at, 
			SUM( exp ) AS total_exp,
			COUNT( * ) AS total_quests
			FROM quests
			WHERE MONTH( updated_at ) = '.$month.'
			AND YEAR( updated_at ) = '.$year.'
			AND finished = 1
			GROUP BY user_id
			ORDER BY total_exp DESC, total_quests DESC, updated_at ASC
		'));	

		
		foreach($ladder as $key => $row) {
			$user = User::find($row->user_id);
			$participant = Ladder::where('user_id', '=', $row->user_id)->where('year', '=', $year)->where('month', '=', $month)->first();
			if($participant) {
				$participant->month_exp = $row->total_exp;
				$participant->total_quests = $row->total_quests;
				$participant->rang = $x;
				$participant->save();
				//echo "\nUser Edit: ".$row->user_id." \n";
			} else {
			    if($month2 = 1) {
					$month2 = 12;
					$year2 = $year-1;
				} else {
					$month2 = $month-1;
				}
				$participant = Ladder::where('user_id', '=', $row->user_id)->where('year', '=', $year2)->where('month', '=', $month2)->first();
				if($participant) {
					$i = $participant->rang;
					if ($i = 1) {
						$user->achievements()->attach(49);
						$achievement = Achievement::where('id', '=', 49)->first();
						$user->notify(1, trans("achievements.receive").$achievement->name);
					} elseif ($i = 2) {
						$user->achievements()->attach(50);
						$achievement = Achievement::where('id', '=', 50)->first();
						$user->notify(1, trans("achievements.receive").$achievement->name);
					} elseif ($i = 3) {
						$user->achievements()->attach(51);
						$achievement = Achievement::where('id', '=', 51)->first();
						$user->notify(1, trans("achievements.receive").$achievement->name);
					} elseif ($i <= 10) {
						$user->achievements()->attach(52);
						$achievement = Achievement::where('id', '=', 52)->first();
						$user->notify(1, trans("achievements.receive").$achievement->name);
					} elseif ($i <= 50) {
						$user->achievements()->attach(53);
						$achievement = Achievement::where('id', '=', 53)->first();
						$user->notify(1, trans("achievements.receive").$achievement->name);
					} elseif ($i <= 100) {
						$user->achievements()->attach(54);
						$achievement = Achievement::where('id', '=', 54)->first();
						$user->notify(1, trans("achievements.receive").$achievement->name);
					}
				}			
				$ladder = new Ladder;
				$ladder->user_id = $row->user_id;
				$ladder->month_exp = $row->total_exp;
				$ladder->total_quests = $row->total_quests;
				$ladder->month = $month;
				$ladder->year = $year;
				$ladder->rang = $x;
				$ladder->save();
				//echo "\nNew User: ".$row->user_id." \n";
			}
			$i++;
			$x++;
		}
		
		//echo "\n\nLadder refreshed \n\n";
	}


}
