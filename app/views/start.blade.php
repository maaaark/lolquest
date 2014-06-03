@extends('layouts.start')
@section('title', trans("landingpage.welcome"))
@section('content')
 <div class="row bullets">
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 info_bullet">
			<div class="bullet">
			  <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/36_92.png" width="100">
			</div>
			<div class="bullet_desc">
			  <h2>{{ trans("start.get_quests") }}</h2>
			  <p>{{ trans("start.get_quests_desc") }}</p>
			  <!-- <p><a class="btn btn-default" href="#" role="button">{{ trans("start.more") }}</a></p> -->
			</div>
			<div class="clear"></div>
        </div><!-- /.col-lg-4 -->
		<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 info_bullet">
		<div class="bullet">
          <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/86_92.png" width="100">
		</div>
		  <div class="bullet_desc">
          <h2>{{ trans("start.get_achievement") }}</h2>
          <p>{{ trans("start.get_achievement_desc") }}</p>

		</div>
        </div><!-- /.col-lg-4 -->
		<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 info_bullet">
		<div class="bullet">
          <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="/img/champions/113_92.png" width="100">
		</div>
		<div class="bullet_desc">
          <h2>{{ trans("start.get_rewards") }}</h2>
          <p>{{ trans("start.get_rewards_desc") }}</p>

		</div>
        </div><!-- /.col-lg-4 -->
</div>
@stop