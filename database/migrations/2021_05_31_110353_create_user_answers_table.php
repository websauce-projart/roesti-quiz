<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('result_id')->unsigned();
            $table->foreign('result_id')->references('id')->on('results')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->boolean('user_answer');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['result_id']);
        });
        Schema::dropIfExists('user_answers');
    }
}
