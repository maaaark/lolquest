@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.rp"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				{{ trans("shop.NA") }}
			</td>
		</tr>
	</table>
@stop