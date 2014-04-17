@extends('layouts.master')
@section('content')
	<h2> {{ trans("users.profile") }} {{ $user->name }}</h2>
@stop