<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddKeyToChampions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('champions', function(Blueprint $table) {
			$table->string('key');
			$table->float('attackrange');
			$table->float('mpperlevel');
			$table->float('mp');
			$table->float('attackdamage');
			$table->float('hp');
			$table->float('hpperlevel');
			$table->float('attackdamageperlevel');
			$table->float('armor');
			$table->float('mpregenperlevel');
			$table->float('hpregen');
			$table->float('critperlevel');
			$table->float('spellblockperlevel');
			$table->float('mpregen');
			$table->float('attackspeedperlevel');
			$table->float('spellblock');
			$table->float('movespeed');
			$table->float('attackspeedoffset');
			$table->float('crit');
			$table->float('hpregenperlevel');
			$table->float('armorperlevel');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('champions', function(Blueprint $table) {
			
		});
	}

}
