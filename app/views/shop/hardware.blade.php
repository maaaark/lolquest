@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.hardware"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12">
					<div class="product_skin" style="background: url('http://images.lolquest.net/products/razer_keyboard_big.jpg');">
						<div class="skin_description_big">
							<h3>Razer Black Widdow</h3>
							Gaming Keyboard<br/>
							<br/>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-skin-1">{{ trans("shop.buy_for") }} 20000 QP</a><br/>
							<br/>
							<a href="#">Not enough QP? Buy it here!</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('http://images.lolquest.net/products/razer_naga.jpg');">
						<div class="skin_description">
							<h3>Razer Naga</h3>
							Gaming Mouse<br/>
							<br/>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-skin-1">{{ trans("shop.buy_for") }} 20000 QP</a><br/>
							<br/>
							<a href="#">Not enough QP? Buy it here!</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('http://images.lolquest.net/products/razer_orca.jpg');">
						<div class="skin_description">
							<h3>Razer Orca</h3>
							Gaming Headset<br/>
							<br/>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-skin-1">{{ trans("shop.buy_for") }} 20000 QP</a><br/>
							<br/>
							<a href="#">Not enough QP? Buy it here!</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('http://images.lolquest.net/products/razer_keyboard.jpg');">
						<div class="skin_description">
							<h3>Razer Black Widdow</h3>
							Gaming Keyboard<br/>
							<br/>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-skin-1">{{ trans("shop.buy_for") }} 20000 QP</a><br/>
							<br/>
							<a href="#">Not enough QP? Buy it here!</a>
						</div>
					</div>
				</div>				
				
			</td>
		</tr>
	</table>
@stop