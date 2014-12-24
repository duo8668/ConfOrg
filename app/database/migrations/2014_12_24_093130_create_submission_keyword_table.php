<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionKeywordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_keyword', function(Blueprint $table)
		{
			$table->integer('Keyword_id')->references('Keyword_id')->on('keywords');
			$table->integer('Sub_id')->references('Sub_id')->on('submissions');
			$table->timestamps();
			$table->primary(array('Keyword_id', 'Sub_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submission_keyword');
	}

}
