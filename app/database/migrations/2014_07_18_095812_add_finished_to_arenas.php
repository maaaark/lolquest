<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFinishedToArenas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arenas', function(Blueprint $table) {
			$table->integer('arena_finished')->default(0);
			$table->integer('arena_quest_started')->default(0);
			$table->bigInteger('arena_quest_start_time')->default(0);
			$table->bigInteger('arena_quest_end_time')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arenas', function(Blueprint $table) {
			
		});
	}

}
