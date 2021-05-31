<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user1_game')->unsigned();
            $table->foreign('id_user1_game')
                    ->references('id_user1')
                    ->on('games')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('id_user2_game')->unsigned();
            $table->foreign('id_user2_game')
                    ->references('id_user2')
                    ->on('games')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->integer('id_categorie');
            $table->integer('id_user_winner');
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
        Schema::dropIfExists('rounds');
    }
}