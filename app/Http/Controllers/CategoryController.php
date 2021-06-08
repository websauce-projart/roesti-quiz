<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Round;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;


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
	 *	Get 3 random categories, store the game ID in session and return the next view
	 * @return view Choose categories
	 **/
	public static function getRandomCategories($round_count)
	{
		// Define a seed so the player doesn't manipulation category generation
		$user_id = Auth::id();

		$faker = \Faker\Factory::create();
		$faker->seed($user_id * $round_count);

		// Get titles from category
		$categories_titles = Category::pluck("title");
		$categories = $faker->randomElements($categories_titles, 3);

		return $categories;
	}

	public static function displayCategoryView($game_id) {
		//Checks if the user is in the game, that it's its turn to choose the category 
		//and that the last round in game has 2 results or that there is not last round
		$user_id = Auth::user()->id;
		$game = Game::where('id', $game_id)->first();

		if($game->active_user_id !== $user_id) {
			return redirect()->route('home');
		}
		

		if(!is_null($game->getLastRound())) { //À vérifier si fonctionne
			$last_round = $game->getLastRound();
			$results_count = $last_round->results()->get()->count();

			//User choose the category and created the round but left before doing the quizz
			if($results_count == 0) {
				return redirect()->route('results', [$game]);
			} 

			//The current round is not over, user shouldn't choose a category
			if($results_count !== 2) {
				dd($results_count);
				return redirect()->route('home');
			}
		}

		


		$rounds = Round::where('game_id', $game_id)->get();
		$round_count = $rounds->count();
		$categories = CategoryController::getRandomCategories($round_count);

		return view('gameloop/choose_categories')
		->with('categories', $categories)
		->with('data', $game_id);
	}
}
