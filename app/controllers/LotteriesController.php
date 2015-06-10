<?php

class LotteriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /lotteries
	 *
	 * @return Response
	 */
    public function lottery()
    {
        $entries = Lottery::all();
        $entries_sum = Lottery::sum("amount");
        return View::make('lottery.index', compact('entries', 'entries_sum'));
    }

    public function enterLottery() {
        if(Auth::check()) {
            $user = User::find(Auth::user()->id);
            $amount = Input::get('amount');

            if(Input::get('buy_with_qp')) {
                $qp_costs = Config::get('api.lottery_costs');
                $qp_amount = $amount * $qp_costs;
                if($user->qp < $qp_amount) {
                    return Redirect::to("/lottery")->with('error', 'Not enought QP.');
                } else {
                    $user->qp = $user->qp - $qp_amount;
                    $lottery = Lottery::where("user_id","=",Auth::user()->id)->first();
                    if(!$lottery) {
                        $lottery = new Lottery();
                        $lottery->amount = 0;
                        $lottery->user_id = Auth::user()->id;
                    }
                    $lottery->amount = $lottery->amount + $amount;

                    $user->save();
                    $lottery->save();

                    return Redirect::to("/lottery")->with('success', 'You have entered the lottery '.$amount.' times.');
                }
            } elseif (Input::get('buy_with_gold')) {
                $gold_costs = Config::get('api.lottery_costs_gold');
                $gold_amount = $amount * $gold_costs;
                if($user->gold < $gold_amount) {
                    return Redirect::to("/lottery")->with('error', 'Not enought QP.');
                } else {
                    $user->gold = $user->gold - $gold_amount;
                    $lottery = Lottery::where("user_id","=",Auth::user()->id)->first();
                    if(!$lottery) {
                        $lottery = new Lottery();
                        $lottery->amount = 0;
                        $lottery->user_id = Auth::user()->id;
                    }
                    $lottery->amount = $lottery->amount + $amount;

                    $user->save();
                    $lottery->save();

                    return Redirect::to("/lottery")->with('success', 'You have entered the lottery '.$amount.' times.');
                }
            } else {
                return Redirect::to("/lottery")->with('error', 'What do you want from me?');
            }

        } else {
            return Redirect::to("/login");
        }
    }

}