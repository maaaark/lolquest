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
			
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('/img/skins/riot_points.jpg')">
						<div class="skin_description">
							<h3>1850 RP</h3>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-6">Buy for 25000 QP</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
					<div class="product_skin" style="background: url('/img/skins/riot_points.jpg')">
						<div class="skin_description">
							<h3>3650 RP</h3>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-6">Buy for 25000 QP</a>
						</div>
					</div>
				</div>
				
			</td>
		</tr>
	</table>
@stop