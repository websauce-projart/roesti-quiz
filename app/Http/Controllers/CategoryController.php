<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Round;
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

	public static function displayCategoryView() {
		$game = session('game');
		// $round = Round::where('game_id', $game->id)->get();
		// dd($round);
		$round_count = $game->rounds()->count();
		$categories = CategoryController::getRandomCategories($round_count);

		return view("gameloop.choose_categories", [
			"categories" => $categories,
			'data' => $game->id
		]);
	}
}
