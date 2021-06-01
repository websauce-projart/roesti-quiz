<?php

namespace Database\Factories;

use App\Models\Round;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Round::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_game' => rand(1,20),
            'id_category' => rand(1,7),
            'id_user_winner' => rand(1,10),
        ];
    }
}
