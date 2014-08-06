<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArenaQuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arena_quests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('champion_id');
			$table->integer('arena_id');
			$table->integer('arena_quest_type_id');
			$table->boolean('finished');
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
		Schema::drop('arena_quests');
	}

}
