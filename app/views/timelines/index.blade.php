@extends('templates.default')
@section('title', trans("timeline.index"))
@section('content')
	<br/>
	@if(Auth::check())
	<a class="btn btn-primary" href="/timeline_settings">{{ trans("timeline.settings_3") }}</a><br/>
	<br/>
	@endif
	@include('timelines.clean_timeline')
	<?php echo $timelines->links(); ?>
@stop