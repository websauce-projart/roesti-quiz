<?php

namespace Database\Seeders;

use App\Models\Round;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Question::factory()
			->count(10)
			->create();
	}
}
