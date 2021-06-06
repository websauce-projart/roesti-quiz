<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ResultController;
use App\Models\Result;

class RoundController extends Controller
{


	/**
	 * Get all rounds from a game
	 * @param $game_id ID of the game which contains the desired rounds
	 * @return
	 */
	public static function getRounds($game_id)
	{
		return Round::where("game_id", $game_id)->get();
	}

	/**
	 * Get last existing round in database
	 * @return Round Last round in database
	 */
	public static function getLastRound()
	{
		return Round::orderBy("created_at", "desc")->first();
	}


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

		$users = GameController::getPlayers($game_id);
		$users_id = [];
		foreach ($users as $user) {
			array_push($users_id, $user->user_id);
		}

		$this->prepareNextRound($round);

		// Store id of the game for next view
		session(["round_id" => $round->id]);

		return ResultController::showResultsView($game_id);
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
		foreach ($questions as $question) {
			$question->rounds()->attach($round);
		}
	}

	/**
	 * Get category for specified round
	 * @param Round $round
	 * @return Category
	 */
	public static function getCategory(Round $round)
	{
		$category_id = $round->category_id;
		$category = Category::where("id", $category_id)->first();
		return $category;
	}
}
