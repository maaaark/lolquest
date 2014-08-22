<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMoreDetailsNewApiToGames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->string('lane');
			$table->string('role');
			$table->float('exp_pm_zeroToTen');
			$table->float('exp_pm_tenToTwenty');
			$table->float('exp_pm_twentyToThirty');
			$table->float('exp_pm_thirtyToEnd');
			$table->float('gold_pm_zeroToTen');
			$table->float('gold_pm_tenToTwenty');
			$table->float('gold_pm_twentyToThirty');
			$table->float('gold_pm_thirtyToEnd');
			$table->float('cs_pm_zeroToTen');
			$table->float('cs_pm_tenToTwenty');
			$table->float('cs_pm_twentyToThirty');
			$table->float('cs_pm_thirtyToEnd');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function(Blueprint $table)
		{
			
		});
	}

}
