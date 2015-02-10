<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSummonerStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('summoner_stats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('summoner_id');
			$table->integer('ingamegold')->default(0);
			$table->integer('games')->default(0);
			$table->integer('wins')->default(0);
			$table->integer('losses')->default(0);
			$table->integer('kills')->default(0);
			$table->integer('assists')->default(0);
			$table->integer('dmg')->default(0);
			$table->integer('heal')->default(0);
			$table->integer('dmgtaken')->default(0);
			$table->integer('wards')->default(0);
			$table->integer('wardkills')->default(0);
			$table->integer('towers')->default(0);
			$table->integer('doublekills')->default(0);
			$table->integer('tripplekills')->default(0);
			$table->integer('quadrakills')->default(0);
			$table->integer('pentakills')->default(0);
			$table->integer('dragons')->default(0);
			$table->integer('barons')->default(0);
			$table->timestamps();
		});
	}
	
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('summoner_stats');
	}

}
