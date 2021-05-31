<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user1')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_user2')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user1_score')->references('id')->on('users'); ;
            $table->integer('user2_score')->references('id')->on('users'); ;
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
        Schema::dropIfExists('games');
    }
}
