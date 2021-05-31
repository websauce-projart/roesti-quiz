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
            $table->integer('id_question')->unsigned();
            $table->foreign('id_question')->references('id')->on('questions')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('id_round')->unsigned();
            $table->foreign('id_round')->references('id')->on('rounds')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
                    
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
        Schema::dropIfExists('question_round');
    }
}
