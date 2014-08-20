@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.betakey"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12">
						<div class="product_skin" style="background: url('http://images.lolquest.net/products/beta_key.jpg');">
							<div class="skin_description_big">
								<h3>Beta Key</h3>
								Buy another lolquest Beta Key and gift it to your friends!<br/>
								<br/>
								@if(Auth::check())
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{ $product->id }}">{{ trans("shop.buy_for") }} 2000 QP</a><br/>
								@else
									<a href="/login" class="btn btn-primary">{{ trans("shop.login_to_buy") }}</a><br/>
								@endif
							</div>
						</div>
					</div>
					@if(Auth::check())
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
									<a href="/shop/buy_betakey" class="btn btn-success">{{ trans("shop.buy") }}</a>
								@endif
							  </div>
							</div>
						</div>
					</div>
					@endif
			</td>
		</tr>
	</table>
@stop