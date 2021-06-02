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
		// Create 10 questions
		Question::factory()
			->count(10)
			->create();

		/**
		 * For each question, attach to:
		 * - an existing category (found according to id)
		 * - an existing round (found according to id)
		 */
		$questions = Question::all();
		$category = Category::find(1);
		$round = Round::find(1);

		foreach ($questions as $question) {
			$question->categories()->attach($category);
			$question->rounds()->attach($round);
		}
	}
}
