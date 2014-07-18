<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArenasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arenas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('rang')->default(0);
			$table->integer('arena_quests')->default(0);
			$table->integer('month');
			$table->integer('year');
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
		Schema::drop('arenas');
	}

}
