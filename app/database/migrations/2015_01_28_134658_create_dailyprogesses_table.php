<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyprogessesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dailyprogesses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('games');
			$table->integer('wins');
			$table->integer('quests_completed');
			$table->integer('top_games');
			$table->integer('jungle_games');
			$table->integer('mid_games');
			$table->integer('bot_games');
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
		Schema::drop('dailyprogesses');
	}

}
