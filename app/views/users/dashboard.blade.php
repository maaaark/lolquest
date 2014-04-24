@extends('templates.full')
@section('title', trans("users.dashboard"))
@section('content')
	Notifications:<br/>
	@foreach($user->notifications as $note)
		{{ $note->message }}<br/>
	@endforeach
	
@stop