<?php

class ArenasController extends \BaseController {

	public function index($year = NULL, $month = NULL)
	{
		$champions = Champion::orderBy("name", "ASC")->get();
			if($year == NULL)
				$year = date("Y");
		
			if($month == NULL)
				$month = date("m");
		
			$arena_ladder = Arena::where('year', '=', $year)->where('month', '=', $month)->orderBy('rang', 'asc')->where("arena_finished", "=", 1)->paginate(25);
			
		if(Auth::check()) {
			$my_arena = Arena::where("user_id", "=", Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->where("arena_finished", "=", 0)->first();
			
			$my_arena_quest = ArenaQuest::where("user_id", "=", Auth::user()->id)->where("finished", "=", 0)->first();
			if($my_arena_quest) {
				return View::make('arena.index', compact('my_arena', 'arena_ladder', 'month', 'year', 'champions', 'my_arena_quest'));
			} else {
				return View::make('arena.index', compact('my_arena', 'arena_ladder', 'month', 'year', 'champions'));
			}
			
			
		} else {
			return View::make('arena.index', compact('arena_ladder', 'month', 'year', 'champions'));
		}
	}


	public function start_arena()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			if($user->qp >= 500) {
				$user->active_arena = 1;
				$user->qp = $user->qp - 500;
				$user->save();
				
				$arena = new Arena;
				$arena->user_id = $user->id;
				$arena->month = date("m");
				$arena->year = date("Y");
				$arena->save();
				
				return Redirect::to("/arena")->with('success', trans("arena.joined"));
			} else {
				return Redirect::to("/arena")->with('error', trans("users.no_qp"));
			}
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function stop_arena() {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$user->active_arena = 0;
			$user->save();
			
			$my_arena_quest = ArenaQuest::where("user_id", "=", Auth::user()->id)->where("finished", "=", 0)->first();
			if($my_arena_quest) {
				$my_arena_quest->delete();
			}
			
			$my_arena = Arena::where("user_id", "=", Auth::user()->id)->where("arena_finished", "=", 0)->first();
			if($my_arena) {
				$my_arena->arena_quest_started  = 0;
				$my_arena->arena_finished = 1;
				$my_arena->save();
			}
			$my_arena->refresh_ladder();
			
			return Redirect::to("/arena");
		} else {
			return Redirect::to("/login");
		}
	}
	
	public function start_quest()
	{
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$my_arena = Arena::where("user_id", "=", $user->id)->where('year', '=', date("Y"))->where('month', '=', date("m"))->where("arena_finished", "=", 0)->first();
			$my_arena->arena_quest_started = 1;
			$my_arena->arena_quest_start_time = date("U");
			$my_arena->arena_quest_end_time = date("U") + 16200; // 3 Hours for a Quest
			$my_arena->save();
			
			$arena_quest = new ArenaQuest;
			$arena_quest->user_id = Auth::user()->id;
			if(Input::get('champion_arena_id') == 0) {			
				$champion = Champion::orderBy(DB::raw('RAND()'))->first();
				$arena_quest->champion_id = $champion->champion_id;
			} else {
				$arena_quest->champion_id = Input::get('champion_arena_id');
			}
			$arena_quest->arena_id = $my_arena->id;
			
			$arena_quest_type = ArenaQuestType::orderBy(DB::raw('RAND()'))->where("stage", "=", $my_arena->arena_quests + 1)->first();	
			$arena_quest->arena_quest_type_id = $arena_quest_type->id;
			$arena_quest->save();
			
			return Redirect::to("/arena")->with('success', trans("arena.quest_started"));
		} else {
			return Redirect::to("/login");
		}
	}
	
	
	
	
	public function finish_quest() {
		if(Auth::check()) {
			$user = User::find(Auth::user()->id);
			$my_arena = Arena::where("user_id", "=", $user->id)->where('year', '=', date("Y"))->where('month', '=', date("m"))->where("arena_finished", "=", 0)->first();
			$my_arena->arena_quests = $my_arena->arena_quests + 1;
			$my_arena->arena_quest_started = 0;
			
			
			$my_arena_quest = ArenaQuest::where("user_id", "=", Auth::user()->id)->where("finished", "=", 0)->first();
			if($my_arena_quest) {
				$my_arena_quest->finished = 1;
				$my_arena_quest->save();
				
				if($my_arena->arena_quest_end_time < date("U") ) {
					$user->active_arena = 0;
					$my_arena->arena_finished = 1;
				}
				
				$user->save();
				$my_arena->save();
				$my_arena_quest->save();
				
				if($user->active_arena == 1) {
					return Redirect::to("/arena")->with('success', trans("arena.quest_finished"));
				} else {
					$my_arena->refresh_ladder();
					$my_old_arena = Arena::where("id", "=", $my_arena_quest->arena_id)->first();
					$end_message = "<h3>Your Arena run has ended!</h3><strong>You completed ".$my_old_arena->arena_quests." quests</strong> and are currently <strong>rang ".$my_old_arena->rang.".</strong><br/>You can play another Arena to beat your previous score and get a better rang. The current Arena will stay in the ladder.";
					return Redirect::to("/arena")->with('success', trans("arena.quest_finished"))->with('message', $end_message);
				}
				
				
			} else {
				return Redirect::to("/arena")->with('error', trans("arena.no_quest"));
			}
			
		} else {
			return Redirect::to("/login");
		}
	}
	
	

}