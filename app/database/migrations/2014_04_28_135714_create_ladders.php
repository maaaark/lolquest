<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLadders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ladders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('rang')->default(0);
			$table->integer('year')->default(date("Y"));
			$table->integer('month')->default(date("m"));
			$table->integer('month_exp')->default(0);
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
		Schema::drop('ladders');
	}

}
