<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RepairChallenges extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'repair:challenges';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
		//$users = User::where("id", "=", 1061)->get();
		foreach($users as $user) {
			$uchallenges = $user->challenges;
			echo "User".$user["id"].$user["name"]."\n";
			foreach($uchallenges as $challenge) {
				$challengeactive = ChallengeUser::where('user_id', '=', $user->id)->where('challenge_id','=',$challenge->id)->count();
				if($challengeactive >= 2 && $challenge->pivot->active == 1){
					$user->challenges()->detach($challenge->id);
					if($challenge->exp == 150) {
						$exp = 100;
						$qp = 10;
					} elseif($challenge->exp == 200) {
						$exp = 150;
						$qp = 15;
					} elseif($challenge->exp == 500) {
						$exp = 200;
						$qp = 25;
					}
					$qp = $qp * $challengeactive;
					$exp = $exp * $challengeactive;
					$user->lifetime_qp-=$qp;
					$user->exp-=$exp;
					$user->qp-=$qp;
					$user->save();
					$level = Level::where('exp', '<=', $user->exp)->where('exp_level', '>', $user->exp)->first();
					if($level){
						$user->level_id = $level->id;
						echo "level auf Stufe ".$level->id." gesetzt \n";
						$user->save();
					}else{
						$user->level_id = 1;
						$user->exp = 0;
						$user->qp-=0;
						$user->save();
					}
					echo "challenge ".$challenge["id"]." ".$challenge["name"]." detached\n";
				}
				$lowchallenge = Challenge::where('type', '=' , $challenge->type)->where('id' , '<' , $challenge->id)->first();
				$challengecheck = ChallengeUser::where('user_id', '=', $user->id)->where('challenge_id','=',$challenge->id)->first();
				if ($lowchallenge && !$challengecheck) {
					$userchallenge = New ChallengeUser;
					$userchallenge->user_id = $user->id;
					$userchallenge->active = 1;
					$userchallenge->challenge_id = $challenge->id;
					$userchallenge->save();
				}
			}
			if($user->qp < 0) {
				$buys = Transaction::where('user_id', '=' , $user->id)->orderBy('created_at', 'desc')->get();
				$again = 1;
				foreach($buys as $buy) {
					if($again != 0){
						$user->qp += $buy->price;
						if($buy->product_id == 1){
							$user->quest_slots -=1;
						}else {
							$skin = Skin::where('user_id', '=' , $user->id)->orderBy('created_at', 'desc')->first();
							$skin->destroy($skin->id);
						}
						$user->save();
						if($user->qp>=0){
							$again = 0;
						}
					}
				}
			}
		}
	}

}
