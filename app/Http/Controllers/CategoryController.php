<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
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
	 *	Get 3 random categories, store the game ID in session and return the next view
	 * @return view Choose categories
	 **/
	public function getRandomCategories(Faker $faker)
	{
		// Define a seed so the player doesn't manipulation category generation
		$game_id = 1;
		$user_id = Auth::id();
		$faker->seed($user_id + $game_id);

		// Get titles from category
		$categories_titles = Category::pluck("title");
		$categories = $faker->randomElements($categories_titles, 3);

		// Store id of the game for next view
		session(["game_id" => $game_id]);

		return view("gameloop.choose_categories", [
			"categories" => $categories
		]);
	}
}
