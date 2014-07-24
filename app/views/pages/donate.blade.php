@extends('templates.default')
@section('title', 'Donate')
@section('content')
	<br/>
	<p>
		We like to keep lolquest.net free for everyone at all time.<br/>
		But sadly this website has to generate some income in order to pay the server bills which are currently about 70$ / 50&euro; each month.<br/>
		<br/>
		If you really like this site, we would be very thankful for any donation.<br/>
		Depending on your donation amount, you can unlock special Donator Rewards!<br/>
		<br/>
		<h2>Your donator rewards</h2>
		<table class="table table-striped">
			<tr>
				<td>Level 1 Donation</td>
				<td>2€ or more</td>
				<td><strong>Special Donator Achievement<br/>
				+  Forum/Comment Badge</strong><br/></td>
			</tr>
			<tr>
				<td>Level 2 Donation</td>
				<td>5€ or more</td>
				<td>
					Everything from Level 1 +<br/>
					<strong>the Profile Title "the gracious"</strong>
				</td>
			</tr>
			<tr>
				<td>Level 3 Donation</td>
				<td>10€ or more</td>
				<td>
					Everything from Level 2 +<br/>
					<strong>
						+ 1 Beta Key<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 4 Donation</td>
				<td>25€ or more</td>
				<td>
					Everything from Level 3 +<br/>
					<strong>
						+ 1 Beta Key (2 total keys)<br/>
						+ early test access to new features<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 5 Donation</td>
				<td>50€ or more</td>
				<td>
					Everything from Level 4 +<br/>
					<strong>
						+ 1 Beta Keys (3 total keys)<br/>
						+ create your own title*<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 6 Donation</td>
				<td>100€ or more</td>
				<td>
					Everything from Level 5 +<br/>
					<strong>
						+ 2 Beta Keys (5 total)<br/>
						+ create your own Quest/Challenge with us!<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 7 Donation</td>
				<td>500€ or more</td>
				<td>
					Everything from Level 6 +<br/>
					<strong>
						+ 5 Beta Keys (10 total)<br/>
						+ have a lunch with the developers!**<br/>
					</strong>
				</td>
			</tr>
		</table>
		<br/>
		<i>The Rewards will be unlocked by an Adminstrator after the donation. It may take up to a few days!</i><br/>
		<br/>
		<i>* We will check the name of the title. You cannot use racist, commercial, bad words and so on as title. We may change it at any time!</i><br/>
		<i>** You have to pay the journey to NRW (Germany) by yourself.</i>
	</p>
	<br/>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="HSGLTACGZSWFN">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
	</form>

@stop