<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumLastReadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_last_reads', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('forum_topic_id');
			$table->timestamp('last_read');
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
		Schema::drop('forum_last_reads');
	}

}
