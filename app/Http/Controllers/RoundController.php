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
		$game_id = session("game_id");

		$round = Round::create([
			"game_id" => $game_id,
			"category_id" => $category_id
		]);

		$users = GameController::getPlayers(1);
		$users_id = [];
		foreach ($users as $user) {
			array_push($users_id, $user->user_id);
		}

		$this->prepareNextRound($round);

		// Store id of the game for next view
		session(["round_id" => $round->id]);

		return view(
			"gameloop.results",
			[
				"users_id" => $users_id,
				"category_title" => $category_title
			]
		);
	}
	
	/**
	 * Pick 10 questions from the round's category and store them
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function prepareNextRound($round)
	{
		//Retrieve next round category
        $category_id = $round->category()->first()->id;

		//Retrieve 10 questions from the category
        $questions = Category::where('id', $category_id)->first()->questions()->get();
        $questions = $questions->shuffle()->slice(0, 10);

		//Add thoses questions into QuestionRound table
		foreach($questions as $question) {
			$question->rounds()->attach($round);
		}
	}
}
