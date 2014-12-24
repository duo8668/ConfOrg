<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conferences', function(Blueprint $table)
		{
			$table->increments('conf_id');
			$table->string('title');
			$table->string('conferencetype');
			$table->string('description');
			$table->string('begindate');
			$table->string('begintime');
			$table->string('enddate');
			$table->string('endtime');
			$table->string('isfree');
			$table->string('speaker');
			$table->string('createdby');
			$table->string('datecreated');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conferences');
	}

}
