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
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('category_question');
    }
}
