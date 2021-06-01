<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');

            $table->integer('id_game')->unsigned();
            $table->foreign('id_game')->references('id')->on('games')
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
        Schema::dropIfExists('game_user');
    }
}
