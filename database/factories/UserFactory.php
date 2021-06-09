<?php

namespace Database\Factories;

use App\Models\Eye;
use App\Models\Pose;
use App\Models\User;
use App\Models\Mouth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
			'mouth_id' => Mouth::all()->random()->id,
			'eye_id' => Eye::all()->random()->id,
			'pose_id' => Pose::all()->random()->id
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
