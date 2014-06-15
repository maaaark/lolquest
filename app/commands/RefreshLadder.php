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
				$participant->rang = $i;
				if ($i = 1) {
					$user->achievements()->attach(49);
					$user->notify(1, trans("achievements.receive").Achievement::where('id', '=', 49)>name);
				} elseif ($i = 2) {
			    	$user->achievements()->attach(50);
					$user->notify(1, trans("achievements.receive").Achievement::where('id', '=', 50)>name);
				} elseif ($i = 3) {
			    	$user->achievements()->attach(51);
					$user->notify(1, trans("achievements.receive").Achievement::where('id', '=', 51)>name);
				} elseif ($i = 10) {
			    	$user->achievements()->attach(52);
					$user->notify(1, trans("achievements.receive").Achievement::where('id', '=', 52)>name);
				} elseif ($i = 50) {
			    	$user->achievements()->attach(53);
					$user->notify(1, trans("achievements.receive").Achievement::where('id', '=', 53)>name);
				} elseif ($i = 100) {
			    	$user->achievements()->attach(54);
					$user->notify(1, trans("achievements.receive").Achievement::where('id', '=', 54)>name);
				}
				$participant->month_exp = $row->total_exp;
				$participant->total_quests = $row->total_quests;
				$participant->save();
			} else {
				$ladder = new Ladder;
				$ladder->user_id = $row->user_id;
				$ladder->month_exp = $row->total_exp;
				$ladder->total_quests = $row->total_quests;
				$ladder->month = $month;
				$ladder->year = $year;
				$ladder->save();
			}
			$i++;
		}
		
		echo "\n\nLadder refreshed \n\n";
	}


}
