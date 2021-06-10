<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('pseudo');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->boolean('admin')->default(false);
			$table->rememberToken();
			$table->timestamps();

			$table->integer('eye_id')->unsigned()->nullable();
            $table->foreign('eye_id')
                    ->references('id')
                    ->on('eyes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

			$table->integer('mouth_id')->unsigned()->nullable();
			$table->foreign('mouth_id')
				->references('id')
				->on('mouths')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->integer('pose_id')->unsigned()->nullable();
			$table->foreign('pose_id')
				->references('id')
				->on('poses')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
