<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionAuthorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_author', function(Blueprint $table)
		{
			$table->integer('Sub_id');
			$table->string('Email', 220)->unique();
			$table->string('FirstName', 220);
			$table->string('LastName', 220);
			$table->string('Organization', 220);
			$table->string('Country', 220);
			$table->string('ShortBio', 220);
			$table->boolean('isPresenting');
			$table->timestamps();
			$table->primary(array('Sub_id', 'Email'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submission_author');
	}

}
