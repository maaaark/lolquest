@extends('templates.full')
@section('title', trans("users.dashboard"))
@section('content')
	<h3>My Quests</h3>
	 <div class="row myquests">
		<div class="col-lg-2 quest">
		  <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/36_92.png" width="100">
		  <h2>Quest 1</h2>
		  <p class="questtext">Play a game with Mundo.</p>
		  <p><a href="#">Reroll this Quest</a></p>
		  <p><a class="btn btn-default" href="#" role="button">Complete this Quest</a></p>
		</div><!-- /.col-lg-4 -->
		<div class="col-lg-2 quest">
		  <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/86_92.png" width="100">
		  <h2>Quest 2</h2>
		  <p class="questtext">Buy at least 5 Wards on Summoners Rift.</p>
		  <p><a href="#">Reroll this Quest</a></p>
		  <p><a class="btn btn-default" href="#" role="button">Complete this Quest</a></p>
		</div><!-- /.col-lg-4 -->
		<div class="col-lg-2 quest">
		  <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/113_92.png" width="100">
		  <h2>Quest 3</h2>
		  <p class="questtext">Win a game as Sejuani.</p>
		  <p><a href="#">Reroll this Quest</a></p>
		  <p><a class="btn btn-default" href="#" role="button">Complete this Quest</a></p>
		</div><!-- /.col-lg-4 -->
		<div class="col-lg-2 quest">
		  <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/57_92.png" width="100">
		  <h2>Quest 4</h2>
		  <p class="questtext">Win a game as Jungle Maokai.</p>
		  <p><a href="#">Reroll this Quest</a></p>
		  <p><a class="btn btn-default" href="#" role="button">Complete this Quest</a></p>
		</div><!-- /.col-lg-4 -->
		<div class="col-lg-2 quest">
		  <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/0_92.png" width="100">
		  <h2>Open Slot</h2>
		  <p class="questtext">Klick to get a new quest</p>
		  <p><a href="#">Reroll this Quest</a></p>
		  <p><a class="btn btn-primary" href="#" role="button">Get random Quest</a></p>
		</div><!-- /.col-lg-4 -->
	</div>

	Notifications:<br/>
	@foreach($user->notifications as $note)
		{{ $note->message }}<br/>
	@endforeach
	
@stop