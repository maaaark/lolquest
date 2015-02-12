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
			if($user->summoner){
				$summonerstats = SummonerStat::where('summoner_id','=', $user->summoner->summonerid)->first();
				if(!$summonerstats){
					$summoner_stats = new SummonerStat;
					$summoner_stats->summoner_id = $user->summoner->summonerid;
					$summoner_stats->save();
				}
				echo "$user->id\n";
			}
			$i=1;
			do
			{
				$searchchallenge = Challenge::where('type', '=', $i)->orderBy('value', 'asc')->first();
				if(!$searchchallenge){
					$i=0;
				} else {
					$check = ChallengeUser::where('user_id','=', $user->id)->where('challenge_id','=',$searchchallenge->id)->first();
					if(!$check) {
						$challenge = New ChallengeUser;
						$challenge->user_id = $user->id;
						$challenge->active = 1;
						$challenge->challenge_id = $searchchallenge->id;
						$i+=1;
						$challenge->save();
					} else {
						$i+=1;
					}
				}
			} while ($i>0);
		}
    }


}
