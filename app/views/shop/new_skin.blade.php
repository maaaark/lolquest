@extends('templates.default')
@section('title', 'Shop')
@section('content')
	<br/>
	<p>{{ trans("shop.new_skin") }}</p>
	<br/>
	<a href="/shop/skins">{{ trans("shop.back_to_shop") }}</a>
@stop