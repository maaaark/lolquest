@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.skins"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('/img/skins/pax_jax.jpg')">
						<div class="skin_description">
							<h3>Pax Jax</h3>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-6">Buy for 25000 QP</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('/img/skins/championship_thresh.jpg')">
						<div class="skin_description">
							<h3>Championship Thresh</h3>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-6">Buy for 25000 QP</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('/img/skins/pax_sivir.jpg')">
						<div class="skin_description">
							<h3>Pax Sivir</h3>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-6">Buy for 25000 QP</a>
						</div>
					</div>
				</div>
				
			</td>
		</tr>
	</table>
@stop