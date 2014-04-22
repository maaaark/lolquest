<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('summoner_id');
			$table->integer('totalDamageDealtToChampions');
			$table->integer('goldEarned');
			$table->integer('item0');
			$table->integer('item1');
			$table->integer('item2');
			$table->integer('item3');
			$table->integer('item4');
			$table->integer('item5');
			$table->integer('item6');
			$table->integer('wardPlaced');
			$table->integer('totalDamageTaken');
			$table->integer('trueDamageDealtPlayer');
			$table->integer('physicalDamageDealtPlayer');
			$table->integer('trueDamageDealtToChampions');
			$table->integer('totalUnitsHealed');
			$table->integer('largestCriticalStrike');
			$table->integer('level');
			$table->integer('neutralMinionsKilledYourJungle');
			$table->integer('magicDamageDealtToChampions');
			$table->integer('magicDamageDealtPlayer');
			$table->integer('neutralMinionsKilledEnemyJungle');
			$table->integer('assists');
			$table->integer('magicDamageTaken');
			$table->integer('numDeaths');
			$table->integer('totalTimeCrowdControlDealt');
			$table->integer('largestMultiKill');
			$table->integer('physicalDamageTaken');
			$table->boolean('win');
			$table->integer('team');
			$table->integer('totalDamageDealt');
			$table->integer('totalHeal');
			$table->integer('minionsKilled');
			$table->integer('timePlayed');
			$table->integer('physicalDamageDealtToChampions');
			$table->integer('championsKilled');
			$table->integer('trueDamageTaken');
			$table->integer('neutralMinionsKilled');
			$table->integer('goldSpent');
			$table->integer('gameId');
			$table->integer('ipEarned');
			$table->integer('spell1');
			$table->integer('spell2');
			$table->integer('teamId');
			$table->string('gameMode');
			$table->integer('mapId');
			$table->boolean('invalid');
			$table->string('subType');
			$table->integer('createDate');
			$table->integer('championId');
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
		Schema::drop('games');
	}

}
