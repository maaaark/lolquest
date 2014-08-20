<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArenaQuestTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arena_quest_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->integer('qp');
			$table->integer('exp');
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
		Schema::drop('arena_quest_types');
	}

}
