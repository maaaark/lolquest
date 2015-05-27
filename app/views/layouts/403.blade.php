@extends('templates.full')
@section('title', 'Access Denied')
@section('content')
<div class="login_form">
	<div class="inner_login">
		<h4>403</h4>
		{{ trans("warnings.403") }}
	</div>
</div>
@stop