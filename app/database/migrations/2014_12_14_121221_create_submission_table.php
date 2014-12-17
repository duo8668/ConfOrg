<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submissions', function(Blueprint $table)
		{
			$table->increments('subId');
			$table->integer('userID');
			$table->integer('subType');
			$table->string('subTitle', 220)->unique();
			$table->text('subAbstract');
			$table->string('subKeywords', 220);
			$table->string('subFilePath', 220);
			$table->text('subRemarks');
			$table->boolean('isAccepted');
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
		Schema::drop('submissions');
	}

}
