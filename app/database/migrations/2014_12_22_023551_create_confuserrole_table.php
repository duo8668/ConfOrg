<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfuserroleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('confuserrole', function(Blueprint $table)
		{
			$table->increments('confuserrole_id');
			$table->integer('role_id')->unsigned()->index();
			$table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
			$table->integer('conf_id')->unsigned()->index();
			$table->foreign('conf_id')->references('conf_id')->on('conferences')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('confuserrole');
	}

}
