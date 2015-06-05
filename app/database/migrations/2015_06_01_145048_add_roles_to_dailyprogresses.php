<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRolesToDailyprogresses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dailyprogesses', function(Blueprint $table)
		{
			$table->integer("fighter_games")->default(0);
            $table->integer("tank_games")->default(0);
            $table->integer("mage_games")->default(0);
            $table->integer("assassin_games")->default(0);
            $table->integer("support_games")->default(0);
            $table->integer("marksman_games")->default(0);
            $table->integer("claimed_fighter")->default(0);
            $table->integer("claimed_tank")->default(0);
            $table->integer("claimed_mage")->default(0);
            $table->integer("claimed_assassin")->default(0);
            $table->integer("claimed_support")->default(0);
            $table->integer("claimed_marksman")->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dailyprogresses', function(Blueprint $table)
		{
			
		});
	}

}
