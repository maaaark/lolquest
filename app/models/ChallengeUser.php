<?php

class ChallengeUser extends \Eloquent {
	protected $fillable = [];
	
	protected $table = 'challenge_user';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array

	public function addchallenges($user_id)
    {
			$i=1;
			do
			{
				$seachchallenge = Challenge::where('type', '=', $i)->orderBy('value', 'asc')->first();
				if(!$seachchallenge){
					$i=0;
				} else {
					$challenge = New ChallengeUser;
					$challenge->user_id = $user_id;
					$challenge->active = 1;
					$challenge->challenge_id = $seachchallenge->id;
					$i+=1;
					$challenge->save();
				}
			} while ($i>0);
    }
	
}