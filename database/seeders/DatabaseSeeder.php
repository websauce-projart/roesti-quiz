<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\GameSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoundSeeder;
use Database\Seeders\ResultSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\UserAnswerSeeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		/********************************
		 * 1. Table population
		 ********************************/
		$this->call([
			EyeSeeder::class,
			MouthSeeder::class,
			PoseSeeder::class,
			UserSeeder::class,
			CategorySeeder::class,
			QuestionSeeder::class,

			//Uncomment the 4 lines down for testing

			//GameSeeder::class,
			//RoundSeeder::class,
			//ResultSeeder::class,
			//UserAnswerSeeder::class
		]);
	}
}
