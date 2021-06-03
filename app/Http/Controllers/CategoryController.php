<?php

namespace App\Http\Controllers;

use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Http\Request;

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
	 * Get random categories
	 *
	 * @param $number Get the number of categories
	 * @return view
	 **/
	public function getRandomCategories(Faker $faker)
	{
		$faker->seed(124);
		$categories_titles = Category::pluck("title");
		$categories = $faker->randomElements($categories_titles, 3);

		return view("gameloop/choose_categories", [
			"categories" => $categories
		]);
	}
}
