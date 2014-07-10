@extends('templates.default')
@section('title', 'Donate')
@section('content')
	<br/>
	<h2>Donate</h2>
	<p>
		We like to keep lolquest.net free for everyone and all time.<br/>
		But sadly this website has to generate some income in order to pay the server bills which are currently about 70$ / 50€ each month.<br/>
		<br/>
		If you really like this site, we would be very thankful for any donation.<br/>
		<br/>
		<h2>Your donator rewards</h2>
		<i>Awesome Stuff</i>
	</p>
	<br/>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="HSGLTACGZSWFN">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
	</form>

@stop