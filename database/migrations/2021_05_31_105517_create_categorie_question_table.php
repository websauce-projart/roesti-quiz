<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_question', function (Blueprint $table) {
            $table->integer('id_question')->unsigned();
            $table->foreign('id_question')->references('id')->on('questions')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('categories')
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
        Schema::dropIfExists('categorie_question');
    }
}
