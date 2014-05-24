@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.buy_qp"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				@foreach($products as $product)
					<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
						<div class="product">
							<img class="img-circle" alt="" src="/img/champions/0_92.png" width="100">
							<h3>{{ $product->name }}</h3>
							<div class="product_description">
							{{ $product->description }}
							</div>
								<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $product->id }}">{{ trans("shop.buy") }}</a><br/>
						</div>
					</div>
				@endforeach
			</td>
		</tr>
	</table>
	
@stop