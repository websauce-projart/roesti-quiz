<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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
	public static function getRandomCategories($game_id)
	{
		// Define a seed so the player doesn't manipulation category generation
		$user_id = Auth::id();

		$faker = \Faker\Factory::create();
		$faker->seed($user_id + $game_id);

		// Get titles from category
		$categories_titles = Category::pluck("title");
		$categories = $faker->randomElements($categories_titles, 3);

		return $categories;
	}

	public static function displayCategoryView() {
		$game = session('game');
		$categories = CategoryController::getRandomCategories($game->id);

		return view("gameloop.choose_categories", [
			"categories" => $categories,
			'data' => $game->id
		]);
	}
}
