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
            'id_user1_game' => rand(0,4),
            'id_user2_game' => rand(5,9),
            'id_categorie' => rand(0,6),
            'id_user_winner' => rand(0,9),
        ];
    }
}
