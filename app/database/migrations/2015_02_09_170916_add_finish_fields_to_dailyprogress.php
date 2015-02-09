<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFinishFieldsToDailyprogress extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dailyprogesses', function(Blueprint $table)
		{
			$table->boolean("claimed_wins");
			$table->boolean("claimed_quests");
			$table->boolean("claimed_top");
			$table->boolean("claimed_jungle");
			$table->boolean("claimed_mid");
			$table->boolean("claimed_bot");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dailyprogress', function(Blueprint $table)
		{
			
		});
	}

}
