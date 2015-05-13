<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RefreshTotalExp extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'refresh:total_exp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate total exp for all users';

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

        $users = User::all();
        foreach($users as $user) {
            $exp = 0;
            $finished_quests = Quest::where("user_id","=",$user->id)->where("finished","=",1)->get();
            foreach($finished_quests as $quest) {
                $exp = $exp + $quest->questtype->exp;
            }
            $user->quest_exp = $exp;
            $user->save();
            echo "$user->id - EXP für User $user->summoner_name gespeichert ($user->exp) \n";
        }
        echo "EXP für alle User berechnet \n";
    }
}
