@extends('templates.default')
@section('title', trans("verify.title"))
@section('content')
		<!--<h2>{{ trans("verify.double_headline") }}</h2>-->
		{{ trans("verify.double_text") }}<br/>
		<br/>
		<br/>
		<h2>{{ trans("verify.step_2_headline") }}</h2>
		{{ trans("verify.step_2") }}
		<div class="verify_string">
			<pre>asdasddsadasda</pre>
		</div>
		<br/>
		<strong>{{ trans("verify.current_runes") }}:</strong><br/>
		<ul>
		@foreach ($runes as $page)
			<li>{{ $page["name"] }}</li>
		@endforeach
		</ul>
		
		<br/>
		<h2>{{ trans("verify.step_3_headline") }}</h2>
		{{ trans("verify.step_3") }}<br/>
		<br/>
		<div class="verify_string">
		<input type="button" class="btn btn-primary" value="{{ trans('verify.refresh') }}" onClick="window.location.reload()" /><br/>
		</div>
@stop