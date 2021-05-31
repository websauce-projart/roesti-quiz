<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idUserOne = rand(1,10);
        $idUserTwo = $idUserOne;
        while($idUserOne == $idUserTwo){
            $idUserTwo = rand(1,10);
        };

        return [
            'id_user2' => $idUserOne,
            'id_user1' => $idUserTwo,
            'user1_score' => 0,
            'user2_score' => 0,
        ];
    }
}
