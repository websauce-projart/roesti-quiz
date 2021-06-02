<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Round;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Round::factory()
			->count(1)
			->create();

		// For each round, attach to an existing game (find according to id)
		$rounds = Round::all();
		$game = Game::find(1);

		foreach ($rounds as $round) {
			$round->game()->attach($game);
		}
	}
}
