<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshTimeline extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'refresh:timeline';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Removes broken quests from timeline';

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
		//echo "\nRemoving broken Quests ...\n";
		
		$timelines = Timeline::where("quest_id", ">", 0)->orderBy("id","desc")->take(125)->get();
		foreach($timelines as $line) {
			$quest = Quest::where('id', '=', $line->quest_id)->first();
			if(!$quest) {
				//echo "Fixed Line $line->id \n";
				$line->delete();
			}
		}
		//echo "Done";
	}


}
