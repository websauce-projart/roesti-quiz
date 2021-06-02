<?php

namespace Database\Seeders;

use App\Models\UserAnswer;
use Illuminate\Database\Seeder;

class UserAnswerSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		UserAnswer::factory()
			->count(10)
			->create();
	}
}
