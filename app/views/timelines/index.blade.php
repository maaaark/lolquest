@extends('templates.default')
@section('title', trans("timeline.index"))
@section('content')
	<br/>
	@include('timelines.clean_timeline')
	<?php echo $timelines->links(); ?>
@stop