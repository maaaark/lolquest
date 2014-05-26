<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTrophyStatusToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->integer('trophy_top')->default(0);
			$table->integer('trophy_jungle')->default(0);
			$table->integer('trophy_mid')->default(0);
			$table->integer('trophy_marksman')->default(0);
			$table->integer('trophy_support')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			
		});
	}

}
