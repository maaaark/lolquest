<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quests', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('type_id');
			$table->integer('champion_id');
			$table->integer('exp');
			$table->integer('finished')->default(0);
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
		Schema::drop('quests');
	}

}
