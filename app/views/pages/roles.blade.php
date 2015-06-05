@extends('templates.default')
@section('title', 'Champion classes/roles')
@section('content')
    <br/>
    <div class="faq">

        <div class="panel panel-default">
            <div class="panel-heading"><strong>Fighter</strong></div>
            <div class="panel-body">
                <ul class="champion_class">
                @foreach($champions as $champion)
                    @if($champion->fighter == 1)
                        <li><a href="/champions/{{ $champion->key }}"><img class="img-circle" alt="{{ $champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="35"><br/>{{ $champion->name }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><strong>Assassin</strong></div>
            <div class="panel-body">
                <ul class="champion_class">
                @foreach($champions as $champion)
                    @if($champion->assassin == 1)
                        <li><a href="/champions/{{ $champion->key }}"><img class="img-circle" alt="{{ $champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="35"><br/>{{ $champion->name }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><strong>Mage</strong></div>
            <div class="panel-body">
                <ul class="champion_class">
                @foreach($champions as $champion)
                    @if($champion->mage == 1)
                        <li><a href="/champions/{{ $champion->key }}"><img class="img-circle" alt="{{ $champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="35"><br/>{{ $champion->name }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><strong>Tank</strong></div>
            <div class="panel-body">
                <ul class="champion_class">
                @foreach($champions as $champion)
                    @if($champion->tank == 1)
                        <li><a href="/champions/{{ $champion->key }}"><img class="img-circle" alt="{{ $champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="35"><br/>{{ $champion->name }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><strong>Marksman</strong></div>
            <div class="panel-body">
                <ul class="champion_class">
                @foreach($champions as $champion)
                    @if($champion->marksman == 1)
                        <li><a href="/champions/{{ $champion->key }}"><img class="img-circle" alt="{{ $champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="35"><br/>{{ $champion->name }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><strong>Support</strong></div>
            <div class="panel-body">
                <ul class="champion_class">
                @foreach($champions as $champion)
                    @if($champion->support == 1)
                        <li><a href="/champions/{{ $champion->key }}"><img class="img-circle" alt="{{ $champion->name }}" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="35"><br/>{{ $champion->name }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>

    </div>
@stop