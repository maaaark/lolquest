@extends('templates.default')
@section('title', 'Shop')
@section('content')
	<br/>
	@foreach($products as $product)
	<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
		<div class="product">
			<img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
			<h2>{{ $product->name }}</h2>
			<div class="product_description">
			{{ $product->description }}
			</div>
			@if($product->cat_id == 2)
				<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $product->id }}">{{ trans("shop.buy") }}</a><br/>
			@else
				<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $product->id }}">{{ trans("shop.buy_for") }} {{ $product->price_qp }} QP</a><br/>
			@endif
		</div>
	</div>
	
	<!-- Modal for QP Warning / Buy -->
			<div class="modal fade" id="myModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">{{ trans("shop.details") }} "{{ $product->name }}"</h4>
					  </div>
					  <div class="modal-body">
						<h2>{{ $product->name }}</h2>
						{{ $product->description }}<br/>
						<br/>
						<table class="table table-striped">
							<tr>
								<td>{{ trans("dashboard.balance") }}</td>
								<td>{{ Auth::user()->qp }}</td>
							</tr>
							<tr>
								<td>{{ trans("shop.price") }}</td>
								<td>-{{ $product->price_qp }}</td>
							</tr>
							<tr>
								<td><strong>{{ trans("dashboard.balance_after") }}</strong></td>
								<td><strong>{{ Auth::user()->qp-$product->price_qp }}</strong></td>
							</tr>
						</table>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("dashboard.close") }}</button>
						@if($product->price_qp > Auth::user()->qp)
							<button type="button" class="btn btn-inactive">{{ trans("dashboard.low_qp") }}</button>	
						@else
							<a href="/shop/buy/{{ $product->id }}" class="btn btn-success">{{ trans("shop.buy") }}</a>
						@endif
					  </div>
					</div>
				</div>
			</div>
			
			
	@endforeach
@stop