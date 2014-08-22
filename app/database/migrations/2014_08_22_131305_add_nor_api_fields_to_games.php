<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNorApiFieldsToGames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->integer('towerKills');
			$table->integer('inhibitorKills');
			$table->boolean('firstTower');
			$table->boolean('firstBaron');
			$table->boolean('firstBlood');
			$table->boolean('firstInhibitor');
			$table->boolean('firstDragon');
			$table->integer('baronKills');
			$table->integer('dragonKills');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function(Blueprint $table)
		{
			
		});
	}

}
