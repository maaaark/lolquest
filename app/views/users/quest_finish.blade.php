@extends('templates.full')
@section('title', 'Quest done!')
@section('content')
<div class="quest_done_background">
	<div class="quest_finish">
		<br/>
		<table>
			<tr>
				<td valign="top" width="120" style="padding-left: 10px;">
					<div class="img-circle q_done"><span class="fa fa-check"></span></div>
					<br/>
					<img class="img-circle" src="/img/champions/{{ $quest->champion->champion_id }}_92.png" width="92">
				</td>
				<td valign="top" width="530">
					<h2 style="margin-top: 0;">Quest done!</h2>
					<p style="font-size: 16px;">
					@if($quest->daily == 1)
						You have completed the Quest <strong>"{{ $quest->questtype->name }}"</strong> and earned {{ $quest->questtype->qp*2 }} QP + {{ $quest->questtype->exp*2 }} EXP!
					@else
						You have completed the Quest <strong>"{{ $quest->questtype->name }}"</strong> and earned {{ $quest->questtype->qp }} QP + {{ $quest->questtype->exp }} EXP!
					@endif
					</p>
					<p>
						<strong>Share this Achievement with your friends</strong><br/>
						<div class="fb-share-button" data-href="https://lolquest.net" data-type="button_count"></div>
						<span style="padding-top: 5px; margin-left: 15px;"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://lolquest.net" data-text="I have finished the Quest &quot;{{ $quest->questtype->name }}&quot; with {{ $quest->champion->name }} on http://lolquest.net!" data-via="lolquest" data-related="lolquest">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></span>
					</p>
					<br/>
					<h3>Go for more quests</h3>
					<p>Go ahead and do quests to earn more QP for awesome Rewards in the Shop!</p>
					<br/>
					<a href="/dashboard" class="btn btn-primary">More Quests</a>
				</td>
			</tr>
		</table>
	</div>
</div>
@stop