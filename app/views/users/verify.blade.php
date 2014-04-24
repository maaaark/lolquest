@extends('templates.default')
@section('content')
	@if($user->summoner_status==1)
		<h2>{{ trans("verify.step_1_headline") }}</h2>
		{{ trans("verify.step_1") }}<br/>
		<br/>
		<br/>
		<h2>{{ trans("verify.step_2_headline") }}</h2>
		{{ trans("verify.step_2") }}
		<div class="verify_string">
			<pre>{{ $user->verify_string }}</pre>
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
		<br/>
	@elseif($user->summoner_status==2)
		<h2>{{ trans("verify.done_headline") }}</h2>
		{{ trans("verify.done") }}
	@elseif($user->summoner_status==0)
		<h2>{{ trans("verify.no_name") }}</h2>
		{{ trans("verify.no_name_disc") }}
	@endif
@stop