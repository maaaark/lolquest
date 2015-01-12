@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.gold_sidebar"))
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
							<h3>Lolquest Gold</h3>
							{{ trans("shop.buy_gold") }}<br/>
							<br/>
							@if(Auth::check())
								<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="2PZ5Q9L4CXY4U">
								<input type="hidden" name="custom" value="{{ Auth::user()->id }}">
								<input type="hidden" name="notify_url" value="http://mark.lolquest.net/payment/paypal_ipn.php">
								<table>
								<tr><td><input type="hidden" name="on0" value="lolquest points"></td></tr>
								<tr><td>
								<div style="text-align: center; width: 100%;">
								<select name="os0">
									<option value="510 lolquest Points">510 Gold - €5,00 EUR</option>
									<option value="1150 lolquest Points">1150 Gold - €10,00 EUR</option>
									<option value="2300 lolquest Points">2300 Gold - €20,00 EUR</option>
									<option value="5700 lolquest Points">5700 Gold - €50,00 EUR</option>
								</select>
								</div>
								</td></tr>
								</table>
								<br/>
								<input type="hidden" name="currency_code" value="EUR">
								<input type="image" src="https://www.sandbox.paypal.com/de_DE/DE/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
								<img alt="" border="0" src="https://www.sandbox.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
								</form>
								
							@else
								<a href="/login" class="btn btn-primary">{{ trans("shop.login_to_buy") }}</a><br/>
							@endif
						</div>
					</div>
				</div>
				
				


			</td>
		</tr>
	</table>
@stop