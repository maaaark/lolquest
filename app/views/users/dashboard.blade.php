@extends('templates.default')
@section('title', trans("users.dashboard"))
@section('content')
    <br/>
    <div class="quest_amount">
        {{ $myquests->count() }} of {{ $user->quest_slots }} {{ trans("dashboard.questlog") }}
        @if($user->quest_slots<4)
            {{ trans("dashboard.quest_slot_add") }}
        @endif
    </div>
    <div class="row myquests">

        @foreach($myquests as $quest)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                @if($quest->daily == 1)
                    <div class="quest daily_ribbon">
                        @else
                            @if($quest->questtype->id == 44 || $quest->questtype->id == 45 || $quest->questtype->id == 46 || $quest->questtype->id == 47 || $quest->questtype->id == 48 || $quest->questtype->id == 49 || $quest->questtype->id == 50 || $quest->questtype->id == 51 || $quest->questtype->id == 52)
                                <div class="quest team_ribbon">
                                    @else
                                        <div class="quest">
                                            @endif
                                            @endif
                                            <a href="/champions/{{ $quest->champion->key }}"><img class="img-circle" alt="{{ $quest->champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $quest->champion->key }}.png" width="100"></a>
                                            <h3>{{ $quest->questtype->name }}</h3>
                                            <p class="questtext">{{ trans("quests.".$quest->type_id) }}<br/>
                                                <br/>
                                                {{ trans("dashboard.with") }} <strong>{{ $quest->champion->name }}</strong></p>
                                            <br/>
                                            @if($quest->daily == 1)
                                                <p><strong>{{ $quest->questtype->qp*2 }} QP + {{ $quest->questtype->exp*2 }} EXP</strong></p>
                                            @else
                                                <p><strong>{{ $quest->questtype->qp }} QP + {{ $quest->questtype->exp }} EXP</strong></p>
                                            @endif

                                            @if($time_waited < Config::get('api.refresh_time'))
                                                <p><button class="btn btn-inactive">{{ trans("dashboard.wait", array('time'=>Config::get('api.refresh_time')-$time_waited)) }}</button></p>
                                            @else
                                                @if(Config::get('api.use_riot_api')  == 0 && $quest->questtype->id == 12)
                                                    <p><a class="btn btn-warning" href="" role="button">{{ trans("dashboard.inactive") }}</a></p>
                                                @else
                                                    <form id="frm" method="post" action="/quests/check_quest/{{ $quest->id }}">
                                                        <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.complete') }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    </form><br/>
                                                @endif
                                            @endif
                                            @if($quest->daily == 1)
                                                <p><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.cancel") }}</a></p><span class="clock"></span>
                                            @else
                                                <p><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $quest->id }}">{{ trans("dashboard.cancel") }}</a></p>
                                            @endif
                                            <p><div class="refresh_cooldown"></div></p>
                                        </div>
                                </div>

                                <!-- Cancel Quest Popup -->
                                <div class="modal fade" id="myModal-{{ $quest->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">{{ trans("dashboard.cancel") }} "{{ $quest->questtype->name }}"</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <td valign="top" width="120"><img class="img-circle" alt="{{ $quest->champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $quest->champion->key }}.png" width="100" style="margin-right: 15px;"></td>
                                                        <td valign="top" width="100%">
                                                            <h3>{{ $quest->questtype->name }}</h3>
                                                            {{ trans("quests.".$quest->type_id) }}<br/>
                                                            <br/>
                                                            <table class="table table-striped payment-table">
                                                                <tr>
                                                                    <td>{{ trans("dashboard.balance") }}</td>
                                                                    <td>{{ $user->qp; }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ trans("dashboard.cancel") }}</td>
                                                                    @if(($quest->createDate + 86400000) > ($time*1000) )
                                                                        <td>-{{ Config::get('costs.delete_daily') }} QP</td>
                                                                    @else
                                                                        <td>{{ trans("dashboard.delete_free") }}</td>
                                                                    @endif
                                                                </tr>
                                                                @if(($quest->createDate + 86400000) > ($time*1000) )
                                                                    <?php $free_in = ($quest->createDate + 86400000)-($time *1000); ?>
                                                                    <tr>
                                                                        <td width="200">{{ trans("dashboard.free_in") }}</td>
                                                                        <td>{{ date("H:i:s",$free_in/1000) }}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td><strong>{{ trans("dashboard.balance_after") }}</strong></td>
                                                                    @if(($quest->createDate + 86400000) > ($time*1000) )
                                                                        <td><strong>{{ $user->qp-Config::get('costs.delete_daily') }}</strong></td>
                                                                    @else
                                                                        <td><strong>{{ $user->qp-0 }}</strong></td>
                                                                    @endif
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("dashboard.close") }}</button>
                                                @if(($quest->createDate + 86400000) > ($time*1000) )
                                                    @if(Config::get('costs.delete_daily') > $user->qp)
                                                        <button type="button" class="btn btn-inactive">{{ trans("dashboard.low_qp") }}</button>
                                                        <a href="/shop" class="btn btn-primary">{{ trans("dashboard.buy_qp") }}</a>
                                                    @else
                                                        <a href="/quests/cancel_quest/{{ $quest->id }}" class="btn btn-danger">{{ trans("dashboard.cancel") }}</a>
                                                        @endif
                                                        @else
                                                                <!-- FREE TO DELETE -->
                                                        <a href="/quests/cancel_quest/{{ $quest->id }}" class="btn btn-danger">{{ trans("dashboard.cancel") }}</a>
                                                    @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @if($myquests->count() < $user->quest_slots)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                        <div class="quest">
                                            {{ Form::model($user, array('action' => 'QuestsController@create_choose_quest', 'name' => 'frm', 'id' => 'frm' )) }}
                                            <img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
                                            <h3>{{ trans("dashboard.choose_slot") }}</h3>
                                            <p class="questtext">{{ trans("dashboard.choose") }}<br/>
                                                <br/>  <br/>
                                                <select name="choose_quest_champion" class="quest_select_champion">
                                                    <option value="0">{{ trans("dashboard.random_champion") }}</option>
                                                    @foreach($champions as $champion)
                                                        <option value="{{ $champion->champion_id }}">{{ $champion->name }}</option>
                                                    @endforeach
                                                </select>
                                                <select name="choose_playerrole" class="quest_select_champion">
                                                    <option value="0">{{ trans("dashboard.random_role") }}</option>
                                                    @foreach($playerroles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <br/>
                                            <br/><br/>
                                            <br/>
                                            @if($user->summoner_status == 2)
                                                <p>{{ Form::submit(trans("dashboard.get"), array('class' => 'btn btn-primary', 'style' => 'margin-top: 22px;', 'name' => 'send', 'id' => 'send', 'onClick' => "this.disabled=true;this.value='Please wait...';this.form.submit();")) }}</p>
                                            @else
                                                <p><a href="/verify" class="btn btn-primary">{{ trans("dashboard.verify_first") }}</a></p>
                                            @endif
                                            {{ Form::close() }}
                                        </div>
                                    </div>

                                @else

                                @endif


                                <?php $free_slots = $user->quest_slots - ($myquests->count()+1); ?>
                                @for ($i = 1; $i <= $free_slots; $i++)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                        @if($user->slot1_cooldown > 0)
                                            <div class="quest">
                                                COOLDOWN
                                                {{ date("H:i:s",$user->slot1_cooldown/1000 - $time) }}
                                            </div>
                                        @else
                                            <div class="quest empty_quest">
                                                {{ trans("dashboard.empty_quests") }}
                                            </div>
                                        @endif

                                    </div>
                                @endfor

                                <?php $buyable_slots = 4 -$user->quest_slots; ?>
                                @for ($i = 1; $i <= $buyable_slots; $i++)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                        <div class="quest maxquests">
                                            {{ trans("dashboard.maximum_quests") }}<br/>
                                            <br/>
                                            <a href="/shop/quest_slot" class="btn btn-primary">{{ trans("dashboard.buy_quest_slots") }}</a>
                                        </div>
                                    </div>
                                @endfor

                    </div>

                    <!--
                    <div class="api_lag">
                        <h4>PLEASE NOTICE</h4>
                        Sometimes your recent games may not be up to date and you can't finish a quest, even if you completed the requirements. Try again a few minutes later. It is possible, that the Riot API is lagging and some games will take some minutes or hours to be shown in the history. There is nothing we can do about this.
                    </div>
                    <br/>-->

                    <div class="daily_quests">
                        <table width="100%">
                            <tr>
                                <td width="50%"><h3>Daily Quests</h3></td>
                                <td style="text-align: right;">
                                    <a href="/refresh_summoner" class="btn btn-primary inactive_at_click">Update daily quests</a><br/>
                                    <div class="daily_reset">Daily reset is at 2AM CET </div>
                                </td>
                            </tr>
                        </table>

                        <br/>
                        <table width="100%" class="table table-striped daily_quests_table">
                            @if(in_array(1, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/leagues/gold_5.png"><br/><br/></td>
                                <td valign="top">
                                    <strong>Win 3 games today</strong><br/>
                                    <div class="daily_description">Win 3 games to claim your daily reward.</div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->wins }} / 3 Wins</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/3)*$dailyprogress->wins,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_wins == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        100 QP + 500 EXP<br/>
                                        @if($dailyprogress->wins == 3)
                                            <form id="frm" method="post" action="/quests/dailyprogress/wins">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endif

                            @if(in_array(2, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/leagues/silver_5.png"><br/><br/></td>
                                <td valign="top">
                                    <strong>Complete 5 Quests today</strong><br/>
                                    <div class="daily_description">Complete 5 quests to claim your daily reward.</div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->quests_completed }} / 5 Quests</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/5)*$dailyprogress->quests_completed,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_quests == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        75 QP + 400 EXP<br/>
                                        @if($dailyprogress->quests_completed == 5)
                                            <form id="frm" method="post" action="/quests/dailyprogress/quests">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endif
                                @if(in_array(3, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/leagues/bronze_5.png"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Top Laner</strong><br/>
                                    <div class="daily_description">Play 2 Games on the Top Lane</div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->top_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->top_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_top == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->top_games >= 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/top">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(4, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/leagues/bronze_5.png"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Mid Laner</strong><br/>
                                    <div class="daily_description">Play 2 Games on the Mid Lane</div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->mid_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->mid_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_mid == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->mid_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/mid">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(5, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/leagues/bronze_5.png"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Jungler</strong><br/>
                                    <div class="daily_description">Play 2 Games in the Jungle</div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->jungle_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->jungle_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_jungle == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->jungle_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/jungle">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(6, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/leagues/bronze_5.png"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Botlane</strong><br/>
                                    <div class="daily_description">Play 2 Games on the Bottom lane</div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->bot_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->bot_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_bot == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->bot_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/bot">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(7, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/roles/fighter.jpg" class="img-circle"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Fighter</strong><br/>
                                    <div class="daily_description">Play 2 Games as Fighter<br/>
                                    Check out <a href="/champion/classes">which champions are fighter.</a>
                                    </div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->fighter_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->fighter_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_fighter == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->fighter_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/fighter">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(8, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/roles/mage.jpg" class="img-circle"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Mage</strong><br/>
                                    <div class="daily_description">Play 2 Games as Mage<br/>
                                        Check out <a href="/champion/classes">which champions are mages.</a></div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->mage_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->mage_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_mage == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->mage_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/mage">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(9, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/roles/tank.jpg" class="img-circle"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Tank</strong><br/>
                                    <div class="daily_description">Play 2 Games as Tank<br/>
                                        Check out <a href="/champion/classes">which champions are tanks.</a></div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->tank_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->tank_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_tank == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->tank_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/tank">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(10, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/roles/assassin.jpg" class="img-circle"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Assassin</strong><br/>
                                    <div class="daily_description">Play 2 Games as Assassin<br/>
                                        Check out <a href="/champion/classes">which champions are assassins.</a></div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->assassin_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->assassin_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_assassin == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->assassin_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/assassin">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(11, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/roles/marksman.jpg" class="img-circle"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Marksman</strong><br/>
                                    <div class="daily_description">Play 2 Games as Marksman<br/>
                                        Check out <a href="/champion/classes">which champions are marksmans.</a></div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->marksman_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->marksman_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_marksman == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->marksman_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/marksman">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                                @if(in_array(12, unserialize($user->daily_quests)))
                            <tr>
                                <td valign="top" width="100"><img width="75" src="/img/roles/support.jpg" class="img-circle"><br/><br/></td>
                                <td valign="top">
                                    <strong>Daily Supporter</strong><br/>
                                    <div class="daily_description">Play 2 Games as Supporter<br/>
                                        Check out <a href="/champion/classes">which champions are supporter.</a></div>
                                    <div class="progress">
                                        <div class="overlay_progress uppercase small" style="text-align: center;">{{ $dailyprogress->support_games }} / 2 Games</div>
                                        <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((100/2)*$dailyprogress->support_games,0) }}% ;"></div>
                                    </div>
                                </td>
                                <td valign="top" width="150" style="text-align: center;">
                                    <br/>
                                    @if($dailyprogress->claimed_support == 1)
                                        <br/>
                                        Already claimed
                                    @else
                                        50 QP + 250 EXP<br/>
                                        @if($dailyprogress->support_games == 2)
                                            <form id="frm" method="post" action="/quests/dailyprogress/support">
                                                <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('dashboard.claim_reward') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @else
                                            <a href="#" class="btn btn-primary not_finished_daily">Claim reward</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                                @endif
                        </table>
                    </div>
                    <br/><br/>
@stop