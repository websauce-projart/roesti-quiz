<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('round_id')->unsigned();
            $table->foreign('round_id')
                    ->references('id')
                    ->on('rounds')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('time')->default(0);
            $table->integer('score')->default(0);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['round_id']);
        });
        Schema::dropIfExists('results');
    }
}
