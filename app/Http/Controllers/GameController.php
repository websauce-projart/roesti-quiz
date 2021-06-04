<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

class GameController extends Controller
{

	/**
	 * Get the two users from a game
	 * @param $game_id ID of the game
	 * @return Array the two users
	 */
	public static function getPlayers($game_id)
	{
		return DB::table("game_user")->where("game_id", $game_id)->get();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return view THOMAS
	 */
	public function store(Request $request)
	{
		$activeUserId = Auth::user()->id;
		$opponentId = $request->user;
		$game = Game::create(['active_user_id' => $activeUserId]);
		$game->users()->attach($activeUserId);
		$game->users()->attach($opponentId);

		$categories = CategoryController::getRandomCategories();

		return view("gameloop.choose_categories", [
			"categories" => $categories,
			'data' => $game->id
		]);
	}

	//Returning vie Home with the datas
	public function displayHome()
	{
		$activeUserId = Auth::user()->id;

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
		return view('home/home')->with('data', $data);
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
