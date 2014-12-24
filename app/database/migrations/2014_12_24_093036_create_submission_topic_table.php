<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTopicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_topic', function(Blueprint $table)
		{
			$table->integer('Topic_id')->references('Topic_id')->on('topics');
			$table->integer('Sub_id')->references('Sub_id')->on('submissions');
			$table->timestamps();
			$table->primary(array('Topic_id', 'Sub_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submission_topic');
	}

}
