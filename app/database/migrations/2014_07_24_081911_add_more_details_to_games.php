<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMoreDetailsToGames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function(Blueprint $table) {
			$table->integer('queueId')->default(0);
			$table->float('gold_per_min')->default(0);
			$table->float('exp_per_min')->default(0);
			$table->float('cs_per_min')->default(0);
			$table->integer('firstBloodKill')->default(0);
			$table->integer('firstBloodAssist')->default(0);
			$table->integer('doubleKills')->default(0);
			$table->integer('tripleKills')->default(0);
			$table->integer('quadraKills')->default(0);
			$table->integer('pentaKills')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function(Blueprint $table) {
			
		});
	}

}
