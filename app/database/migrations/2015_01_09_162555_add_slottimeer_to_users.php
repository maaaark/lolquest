<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSlottimeerToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->bigInteger("slot1_cooldown");
			$table->bigInteger("slot2_cooldown");
			$table->bigInteger("slot3_cooldown");
			$table->bigInteger("slot4_cooldown");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			
		});
	}

}
