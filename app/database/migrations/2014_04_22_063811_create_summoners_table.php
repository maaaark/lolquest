<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSummonersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('summoners', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('summonerid');
			$table->string('name');
			$table->integer('profileIconId');
			$table->integer('summonerLevel');
			$table->integer('revisionDate');
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
		Schema::drop('summoners');
	}

}
