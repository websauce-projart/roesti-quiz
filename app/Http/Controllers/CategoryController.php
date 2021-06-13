<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Round;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
	// À SUPPRIMER SI UTILISÉE NULLE PART !!!!
	// /**
	//  * Get all categories
	//  *
	//  * @return class All categories
	//  */
	// public static function getAll()
	// {
	// 	return Category::all();
	// }

	public static function displayCategoryView($game_id)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$game = Game::where('id', $game_id)->first();

		//Checks that the user is the active user in game
		if ($game->active_user_id !== $user_id) {
			return redirect()->route('home');
		}

		if (!is_null($game->getLastRound())) {
			$last_round = $game->getLastRound();
			$results_count = $last_round->results()->get()->count();

			//User choose the category and created the round but left before doing the quizz
			if ($results_count == 0) {
				return redirect()->route('results', [$game]);
			}

			//The current round is not over, user shouldn't choose a category
			if ($results_count !== 2) {
				return redirect()->route('home');
			}
		}

		//Get 3 random categories
		$rounds = Round::where('game_id', $game_id)->get();
		$round_count = $rounds->count();
		$categories = Category::getRandomCategories($round_count, $game_id, $user_id);

		//Return view
		return view('gameloop/choose_categories')
			->with('categories', $categories)
			->with('data', $game_id);
	}
}
