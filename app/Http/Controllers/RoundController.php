<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GameController;

class RoundController extends Controller
{

	/**
	 * Create a round, store it and return the next view
	 * @return view Results page
	 */
	public function createRound(Request $request)
	{
		$category_title = $request->input("categories");
		$category_id = Category::where("title", $category_title)->first()->id;

		Round::create([
			"game_id" => session("game_id"),
			"category_id" => $category_id
		]);

		$users = GameController::getPlayers(1);
		$users_id = [];
		foreach ($users as $user) {
			array_push($users_id, $user->user_id);
		}

		return view(
			"gameloop.results",
			[
				"users_id" => $users_id,
				"category_title" => $category_title
			]
		);
	}
}
