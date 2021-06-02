<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Question::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'label' => $this->faker->sentence(),
			'answer_boolean' => $this->faker->boolean(),
			'answer_label' => $this->faker->sentence(),
			'author_id' => 1
		];
	}
}
