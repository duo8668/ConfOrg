<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('Review_id');
			$table->integer('Sub_id')->references('Sub_id')->on('submissions');
			$table->integer('User_id');
			$table->text('InternalComment');
			$table->text('Comment');
			$table->integer('QualityScore');
			$table->integer('RelevanceScore');
			$table->integer('OriginalityScore');
			$table->integer('SignificanceScore');
			$table->integer('PresentationScore');
			$table->integer('Recommendation');
			$table->integer('ReviewerFamiliarity');
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
		Schema::drop('reviews');
	}

}
