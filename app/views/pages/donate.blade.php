@extends('templates.default')
@section('title', 'Donate')
@section('content')
	<br/>
	<p>
		We like to keep lolquest.net free for everyone at all time.<br/>
		<br/>
		If you really like this site, we would be very thankful for any donation to keep up the developing and bring you rewards for ladder and shop.<br/>
		Depending on your donation amount, you can unlock special Donator Rewards!<br/>
		<br/>
		<div class="bs-callout bs-callout-info">
		<h3>READ THIS!</h3>
		If you don't want to donate, we are totally fine with it. If you only donate because you want a beta key, please keep in mind, we will give out beta keys on our social media and special events!<br/>
		<br/>
		We don't want to rip of money from our users! The beta key for a donation is only a little "thank you" we'd like to give you for your support while the beta.<br/>
		</div>
		<br/>
		<div style="width: 100%; text-align: center;">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="HSGLTACGZSWFN">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
		</form>
		</div>
		<br/>
		<h2>Your donator rewards</h2>
		<table class="table table-striped">
			<tr>
				<td>Level 1 Donation</td>
				<td>5€ or more</td>
				<td>
					<strong>Beta Access / Beta Key<br/>
					+ Special Donator Achievement<br/>
					+ profile title "Donator"<br/></strong>
				</td>
			</tr>
			<tr>
				<td>Level 2 Donation</td>
				<td>10€ or more</td>
				<td>
					Everything from Level 1 +<br/>
					<strong>profile title "the gracious"</strong><br/>
				</td>
			</tr>
			<tr>
				<td>Level 3 Donation</td>
				<td>25€ or more</td>
				<td>
					Everything from Level 2 +<br/>
					<strong>
						+ early test access to new features<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 4 Donation</td>
				<td>50€ or more</td>
				<td>
					Everything from Level 3 +<br/>
					<strong>
						+ create your own title*<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 5 Donation</td>
				<td>100€ or more</td>
				<td>
					Everything from Level 4 +<br/>
					<strong>
						+ create your own Quest/Challenge with us!<br/>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Level 6 Donation</td>
				<td>500€ or more</td>
				<td>
					Everything from Level 5 +<br/>
					<strong>
						+ have a lunch with the developers!**<br/>
					</strong>
				</td>
			</tr>
		</table>
		<br/>
		<div style="width: 100%; text-align: center;">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="HSGLTACGZSWFN">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
		</form>
		</div>
		<br/><br/>
		<i><strong>IMPORTANT</strong><br/>The Rewards will be unlocked by an Adminstrator after the donation. It may take up to a few days! If you don't want your name shown up in the "Top Donator" or "Recent Donator" list, please write this in your donation.</i><br/>
		<br/>
		<i>* We will check the name of the title. You cannot use racist, commercial, bad words and so on as title. We may change it at any time!</i><br/>
		<i>** You have to pay the journey to NRW (Germany/Essen) by yourself.</i>
	</p>
	<br/><br/>
			<table style="width: 100%">
			<tr>
				<td valign="top" style="width: 50%;">
					<h3>Top 10 Donations</h3>
					<table class="table table-striped">
						<tr>
							<th>Name</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>Anonymous</td>
							<td>20&euro;</td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<h3>Recent Donations</h3>
					<table class="table table-striped">
						<tr>
							<th>Name</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>Anonymous</td>
							<td>20&euro;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br/>

@stop