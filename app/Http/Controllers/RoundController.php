<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Round;
use Illuminate\Http\Request;

class RoundController extends Controller
{
	/**
	 * Store round
	 */
	public function store(Request $request)
	{
		$category_title = $request->input("categories");
		$category_id = Category::where("title", $category_title)->first()->id;

		Round::create([
			"game_id" => session("game_id"),
			"category_id" => $category_id
		]);
	}
}
