<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRolesToChampions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('champions', function(Blueprint $table)
		{
			$table->integer("fighter")->default(0);
            $table->integer("tank")->default(0);
            $table->integer("marksman")->default(0);
            $table->integer("support")->default(0);
            $table->integer("mage")->default(0);
            $table->integer("assassin")->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('champions', function(Blueprint $table)
		{
			
		});
	}

}
