<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = User::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'pseudo' => $this->faker->username(),
			'email' => $this->faker->unique()->safeEmail(),
			'email_verified_at' => now(),
			'password' => 'password',
			'remember_token' => Str::random(10),
			'mouth_id' => 1,
			'eye_id' => 1,
			'pose_id' => 1
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 *
	 * @return \Illuminate\Database\Eloquent\Factories\Factory
	 */
	public function unverified()
	{
		return $this->state(function (array $attributes) {
			return [
				'email_verified_at' => null,
			];
		});
	}
}
