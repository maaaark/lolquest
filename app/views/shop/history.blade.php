@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.history"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				<table class="table table-striped transactions">
					@foreach($transactions as $transaction)
						<tr>
							@if($transaction->product)
								<td><strong>{{ $transaction->product->name }}</strong></td>
								<td>{{ $transaction->price }} {{ $transaction->currency }}</td>
								<td>{{ $transaction->description }}</td>
								<td>{{ date("d.m.Y - H:i:s",strtotime($transaction->created_at)) }}</td>
							@else
								<td colspan="4">-</td>
							@endif
						</tr>
					@endforeach	
				</table>
			</td>
		</tr>
	</table>
@stop