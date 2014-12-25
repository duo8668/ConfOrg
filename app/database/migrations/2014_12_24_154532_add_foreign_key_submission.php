<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeySubmission extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('submissions', function(Blueprint $table)
		{
			//add foreign key to submission table
			$table->integer('User_id')->unsigned();
			$table->foreign('User_id')->references('user_id')->on('users');
		});

		Schema::table('reviews', function(Blueprint $table)
		{
			//add foreign key to reviews table
			$table->integer('User_id')->unsigned();
			$table->foreign('User_id')->references('user_id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('submissions', function(Blueprint $table)
		{
			$table->dropForeign('submissions_user_id_foreign');
		});

		Schema::table('reviews', function(Blueprint $table)
		{
			$table->dropForeign('reviews_user_id_foreign');
		});
	}

}
