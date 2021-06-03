<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GameController extends Controller
{

	/**
	 * Display view for the main game loop
	 **/
	public function showGameloopView()
	{
		return view("gameloop/game");
	}

	/**
	 * Test
	 */
	public function displayGames()
	{
		$activeUserId = 1;

		$user = User::where('id', $activeUserId)->first();

		$games = $user->games;

		$data = [];
		foreach ($games as $game) {
			$gameId = $game->id;

			$opponent = $user->getOtherUser($gameId);

			$gameData = array(
				"user" => $user,
				"opponent" => $opponent,
				"game" => $game
			);

			array_push($data, $gameData);
		}
		return view('gameloop/games')->with('data', $data);
	}
}
