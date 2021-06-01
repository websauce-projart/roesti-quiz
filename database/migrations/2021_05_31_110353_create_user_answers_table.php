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
            $table->integer('id_question')->unsigned();
            $table->foreign('id_question')->references('id')->on('questions')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('id_result')->unsigned();
            $table->foreign('id_result')->references('id')->on('results')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->boolean('user_answer');

                    
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
        Schema::dropIfExists('user_answers');
    }
}
