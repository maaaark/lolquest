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
				@foreach($champions as $champion)
					<?php
						if(!in_array($champion->champion_id, $bought_skins)) {
					?>
					
						<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-6">
							<div class="product">
								<img class="img-circle" alt="" src="http://ddragon.leagueoflegends.com/cdn/5.8.1/img/champion/{{ $champion->key }}.png" width="100">
								<h3>{{ $champion->name }}</h3>
								Site Background for {{ $champion->name }}<br/>
								<br/>
								@if(Auth::check())
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal-skin-{{ $champion->champion_id }}">{{ trans("shop.buy_for") }} 200 QP</a><br/>
								@else
									<a href="/login" class="btn btn-primary" data-toggle="modal" data-target="#myModal-skin-{{ $champion->champion_id }}">{{ trans("shop.login_to_buy") }}</a><br/>
								@endif
								
							</div>
						</div>
						
						@if(Auth::check())
						<!-- Modal for QP Warning / Buy -->
						<div class="modal fade" id="myModal-skin-{{ $champion->champion_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">{{ trans("shop.details") }} "{{ $champion->name }}"</h4>
								  </div>
								  <div class="modal-body">
									<h2>{{ $champion->name }} Siteskin</h2>
									Left and right siteskin<br/>
									<br/>
									<table class="table table-striped">
										<tr>
											<td>{{ trans("dashboard.balance") }}</td>
											<td>{{ Auth::user()->qp }}</td>
										</tr>
										<tr>
											<td>{{ trans("shop.price") }}</td>
											<td>-200</td>
										</tr>
										<tr>
											<td><strong>{{ trans("dashboard.balance_after") }}</strong></td>
											<td><strong>{{ Auth::user()->qp-200 }}</strong></td>
										</tr>
									</table>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans("dashboard.close") }}</button>
									@if(200 > Auth::user()->qp)
										<button type="button" class="btn btn-inactive">{{ trans("dashboard.low_qp") }}</button>	
									@else
										<form id="frm" method="post" action="/shop/buy_skin/{{ $champion->champion_id }}">
											<input type="submit" onclick="this.disabled=true;this.value='Please wait...';this.form.submit();" class="btn btn-success" value='{{ trans("shop.buy") }}'>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										</form>
									@endif
								  </div>
								</div>
							</div>
						</div>	
						@endif
					<?php
						}
					?>
				@endforeach	
			</td>
		</tr>
	</table>
@stop