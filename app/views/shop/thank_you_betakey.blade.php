@extends('templates.default')
@section('title', 'Shop')
@section('content')
	<div class="bs-callout bs-callout-success">
		{{ trans("shop.new_beta_key") }}
	</div>
	<h4>Your Beta Key is: {{ $product->key }}</h4></p>
	<br/>
	<a href="/shop">{{ trans("shop.back_to_shop") }}</a>
@stop