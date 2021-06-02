<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionRoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_round', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('round_id')->unsigned();
            $table->foreign('round_id')->references('id')->on('rounds')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
                    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_round', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['round_id']);
        });
        Schema::dropIfExists('question_round');
    }
}
