@extends('templates.default')
@section('title', "Lottery")
@section('content')
    <br/>
    @if(Auth::check())

        @if(Auth::user()->lottery)
            <h3>You have {{ Auth::user()->lottery->amount }} lottery tickets.</h3>
        @else
            <h3>You have 0 lottery tickets.</h3>
        @endif

        Take part in the lottery<br/>
        <form id="frm" method="post" action="/lottery/enterlottery">
            <input name="amount" type="text" value="1">
            <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('lottery.join') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    @else
        You have to be logged in to take part in the lottery.
    @endif


@stop