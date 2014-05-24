<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChampionQuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('champion_quests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('quest_date');
			$table->integer('champion_id');
			$table->integer('quest_count');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('champion_quests');
	}

}
