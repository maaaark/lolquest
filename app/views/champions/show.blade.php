@extends('templates.default')
@section('title', $champion->name)
@section('content')
	<img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/{{ $champion->champion_id }}_92.png" width="40">
@stop