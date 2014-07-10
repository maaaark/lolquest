@if(Config::get('api.problems') == 1)
<div class="bs-callout bs-callout-danger">
		{{ trans("warnings.api_error") }}
</div>
@endif

@if(Session::has('success'))
	<div class="bs-callout bs-callout-success">
		{{ Session::get('success') }}
	</div>
@endif

@if(Session::has('message'))
		<div class="bs-callout bs-callout-warning">
			{{ Session::get('message') }}
		</div>
@endif
@if(Session::has('error'))
	<div class="bs-callout bs-callout-danger">
		{{ Session::get('error') }}
	</div>
@endif
@if(Session::has('status'))
	<div class="bs-callout bs-callout-success">
		{{ Session::get('status') }}
	</div>
@endif

@if(Auth::check())
	@if(Auth::user()->summoner_status == 0)
	<div class="bs-callout bs-callout-warning">
		<h4>Warning!</h4>
		{{ trans("users.empty_summoner") }}
	</div>
	@elseif(Auth::user()->summoner_status == 1)
	<div class="bs-callout bs-callout-warning">
		{{ trans("users.not_verified") }}
	</div>
	@endif
@endif