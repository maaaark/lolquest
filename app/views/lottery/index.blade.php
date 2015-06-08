@extends('templates.default')
@section('title', "Teams")
@section('content')
    <br/>
    @if(Auth::check())
        @if(Auth::user()->team_id == 0)
            <a href="/teams/create" class="btn btn-primary">{{ trans("teams.create_new") }}</a><br/>
            <br/>
        @endif
    @endif
    <table width="100%">
        <tr>
            <td>
                <table class="table table-striped">
                    <tr>
                        <th>User ({{ $entries->count() }} User)</th>
                        <th>{{ trans("lottery.entries") }} ( {{ $entries_sum }} entries )</th>
                    </tr>
                    @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->user->summoner_name }}</td>
                            <td>{{ $entry->amount }} - {{ $entry->amount * 100 / $entries_sum }}% Win chance</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td>
                Take part in the lottery<br/>
                <form id="frm" method="post" action="/lottery/enterlottery">
                    <input name="amount" type="text" value="1">
                    <input class="inactive_at_click btn btn-success" type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" value="{{ trans('lottery.join') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </td>
        </tr>
    </table>

@stop