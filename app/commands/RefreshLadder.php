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
		$model = new AchievementUser;
		$model->setTable("achievement_user");
		
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
