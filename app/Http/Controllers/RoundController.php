<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ResultController;
use App\Models\UserAnswer;

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
		$game = session("game");
		$game_id = $game->id;

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

		// Store round for next view
		session(["round" => $round]);

		return ResultController::showResultsView();
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



	/**
	 * Show the round history view
	 * @param Requestion $request
	 * @return View Round history
	 */
	public function showHistoryView(Request $request)
	{
		$game_id = session('game')->id;

		// Retrieve questions of the round
		$round_id = $request->input("round_id");
		$round = Round::find($round_id);
		$questions = $round->getQuestions();

		// Retrieve players
		$user = User::where('id', Auth::user()->id)->first();
		$opponent = $user->getOtherUser($game_id);

		// Retrieve answers for user and opponent
		$round_result = Result::where("round_id", $round_id);
		$user_result = $round_result->where("user_id", $user->id)->first();
		$opponent_result = $round_result->where("user_id", $opponent->id)->first();

		$user_answers = null;
		if ($user_result) {
			$user_answers = UserAnswer::where("result_id", $user_result->id)->get();
		}

		$opponent_answers = null;
		if ($opponent_result) {
			$opponent_answers = UserAnswer::where("result_id", $opponent_result->id)->get();
		}

		return view("gameloop.round_history", [
			"questions" => $questions,
			"user" => [
				"object" => $user,
				"answers" => $user_answers
			],
			"opponent" => [
				"object" => $opponent,
				"answers" => $opponent_answers
			]
		]);
	}
}
