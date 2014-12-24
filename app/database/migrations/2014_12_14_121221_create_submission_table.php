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
		//TODO: Put foreign Key for Conference & User Table
		Schema::create('submissions', function(Blueprint $table)
		{
			$table->increments('Sub_id');
			$table->integer('User_id');
			$table->integer('Conf_id')->references('ConfId')->on('conference');
			$table->integer('SubType');
			$table->string('SubTitle', 220)->unique();
			$table->text('SubAbstract');
			$table->string('AttachmentPath', 220);
			$table->text('SubRemarks');
			$table->boolean('IsAccepted');
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
