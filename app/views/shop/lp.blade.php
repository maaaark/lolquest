@extends('templates.default')
@section('title', trans("shop.shop").' - '.trans("shop.ep_boost"))
@section('content')
	<br/>
	<table width="100%">
		<tr>
			<td valign="top" width="20%">
				@include('shop.sidebar')
			</td>
			<td valign="top" width="80%">
				<!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="C5GURE9P3T8PG">
					<input type="hidden" name="custom" value="{{ Auth::user()->id }}">
					<input type="hidden" name="notify_url" value="http://mark.lolquest.net/payment/paypal_ipn.php">
					<input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
					<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
				</form>
				
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="2PZ5Q9L4CXY4U">
					<input type="hidden" name="custom" value="{{ Auth::user()->id }}">
					<input type="hidden" name="notify_url" value="http://mark.lolquest.net/payment/paypal_ipn.php">
					<input type="image" src="https://www.sandbox.paypal.com/de_DE/DE/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
					<img alt="" border="0" src="https://www.sandbox.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
				</form>
				-->
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="2PZ5Q9L4CXY4U">
				<input type="hidden" name="custom" value="{{ Auth::user()->id }}">
				<input type="hidden" name="notify_url" value="http://mark.lolquest.net/payment/paypal_ipn.php">
				<table>
				<tr><td><input type="hidden" name="on0" value="lolquest points">lolquest.net Points</td></tr><tr><td><select name="os0">
					<option value="500 lolquest Points">500 lolquest Points €5,00 EUR</option>
					<option value="1150 lolquest Points">1150 lolquest Points €10,00 EUR</option>
					<option value="2300 lolquest Points">2300 lolquest Points €20,00 EUR</option>
					<option value="5700 lolquest Points">5700 lolquest Points €50,00 EUR</option>
				</select> </td></tr>
				</table>
				<br/>
				<input type="hidden" name="currency_code" value="EUR">
				<input type="image" src="https://www.sandbox.paypal.com/de_DE/DE/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
				<img alt="" border="0" src="https://www.sandbox.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
				</form>


			</td>
		</tr>
	</table>
@stop