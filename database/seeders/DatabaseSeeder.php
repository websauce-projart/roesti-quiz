<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use App\Models\Category;
use App\Models\Question;
use App\Models\UserAnswer;
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
			GameSeeder::class,
			RoundSeeder::class,
			ResultSeeder::class,
			UserAnswerSeeder::class
		]);
	}
}
