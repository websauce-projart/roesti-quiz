<?php

namespace Database\Factories;

use App\Models\UserAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAnswerFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = UserAnswer::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		static $question_id = 1;
		return [
			'question_id' => $question_id++,
			'result_id' => 1,
			'user_answer' => $this->faker->boolean()
		];
	}
}
