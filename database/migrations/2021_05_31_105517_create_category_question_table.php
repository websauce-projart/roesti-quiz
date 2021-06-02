<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryQuestionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_question', function (Blueprint $table) {
			$table->integer('question_id')->unsigned();
			$table->foreign('question_id')->references('id')->on('questions')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_question', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('category_question');
    }
}
