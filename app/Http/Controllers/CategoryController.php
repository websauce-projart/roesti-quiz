<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Round;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
	/**
	 * Get all categories
	 *
	 * @return class All categories
	 */
	public static function getAll()
	{
		return Category::all();
	}

	/**
	 *	Return 3 random categories
	 * @return array contains 3 random categories
	 **/
	public static function getRandomCategories($round_count, $game_id)
	{
		// Define a seed so the player doesn't manipulate category generation
		$user_id = Auth::id();

		$faker = \Faker\Factory::create();
		$faker->seed(($user_id + $round_count + $game_id) * $user_id);

		// Get titles from category
		$categories_titles = Category::pluck("title");
		$categories = $faker->randomElements($categories_titles, 3);

		return $categories;
	}

	public static function displayCategoryView($game_id)
	{
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

		$rounds = Round::where('game_id', $game_id)->get();
		$round_count = $rounds->count();
		$categories = CategoryController::getRandomCategories($round_count, $game_id);

		return view('gameloop/choose_categories')
			->with('categories', $categories)
			->with('data', $game_id);
	}
}
