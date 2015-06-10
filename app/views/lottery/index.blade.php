@extends('templates.default')
@section('title', "Lottery")
@section('content')
    <br/>
    @if(Auth::check())

        <table width="100%">
            <tr>
                <td width="50%" valign="top">
                    <strong>What is the lottery?</strong><br/>
                    You can buy lottery tickets to enter the pool for the current month.<br/>
                    At the end of the month, the winners of the current lottery will be picked.<br/>
                    The winners are choosen randomly. You can increase you win chance by getting more lottery tickets.<br/>
                    <br/>
                    <strong>In this month lottery you can win:</strong><br/>
                    <br/>
                    <ul>
                        <li>Rank 1: 10 EUR Paysafecard</li>
                        <li>Rank 2: 5 EUR Paysafecard</li>
                        <li>Rank 3: 1000 QP + 250 lolquest Gold</li>
                        <li>Rank 4: 200 lolquest Gold</li>
                    </ul>
                    <br/>
                    <span class="close_date">This lottery closes 30.06.2015 at 23:59 CET</span>
                </td>
                <td valign="top" class="text-center">
                    @if(Auth::user()->lottery)
                        <h3>You have {{ Auth::user()->lottery->amount }} lottery tickets.</h3>
                    @else
                        <h3>You have 0 lottery tickets.</h3>
                    @endif
                    <br/>
                    How many lottery tickets do you want to buy?<br/>
                    <form id="frm" method="post" action="/lottery/enterlottery">
                        <select class="lottery_button" name="amount" id="buy_ticket_amount">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <br/>
                        <br/>
                        <input name="buy_with_qp" class="inactive_at_click btn btn-primary lottery_button" id="lottery_qp_button" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('lottery.join_qp') }}">
                        <br/>

                        @if(Config::get('api.gold_option') == 1)
                        <br/>
                        <input name="buy_with_gold" class="inactive_at_click btn btn-success lottery_button" id="lottery_gold_button" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('lottery.join_gold') }}">
                        @endif

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </td>
            </tr>
        </table>

    @else
        You have to be logged in to take part in the lottery.
    @endif


@stop