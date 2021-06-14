<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use App\Models\Category;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoundController extends Controller
{


	// À SUPPRIMER SI UTILISÉE NULLE PART !!!!
	// /**
	//  * Get all rounds from a game
	//  * @param $game_id ID of the game which contains the desired rounds
	//  * @return
	//  */
	// public static function getRounds($game_id)
	// {
	// 	return Round::where("game_id", $game_id)->get();
	// }

	//À SUPPRIMER SI UTILISÉE NULLE PART !!!!
	// /**
	//  * Get last existing round in database
	//  * @return Round Last round in database
	//  */
	// public static function getLastRound()
	// {
	// 	return Round::orderBy("created_at", "desc")->first();
	// }

	/**
	 * Create a round, store it and return the next view
	 *
	 * @param  Request $request
	 * @param  int $game_id
	 * @return view gameloop/results
	 */
	public function createRound(Request $request, $game_id)
	{
		//Retrieve data
		$category_title = $request->input("categories");
		$category_id = Category::where("title", $category_title)->first()->id;

		//Create round
		$round = Round::create([
			"game_id" => $game_id,
			"category_id" => $category_id
		]);

		//Prepare questions for this round
		$this->prepareQuestions($round);

		//Return redirect
		return redirect()->route('results', [$game_id]);
	}

	//À SUPPRIMER SI UTILISÉE NULLE PART !!!!
	// /**
	//  * Get category for specified round
	//  * @param Round $round
	//  * @return Category $category
	//  */
	// public static function getCategory(Round $round)
	// {
	// 	$category_id = $round->category_id;
	// 	$category = Category::where("id", $category_id)->first();
	// 	return $category;
	// }

	
	/**
	 * Return the round history view
	 *
	 * @param  int $game_id
	 * @param  int $round_id
	 * @return view gameloop/history
	 */
	public function showHistoryView($game_id, $round_id)
	{
		// Retrieve questions of the round
		$round = Round::find($round_id);
		$questions = $round->getQuestions();

		// Retrieve players
		$user = User::where('id', Auth::user()->id)->first();
		$opponent = $user->getOtherUser($game_id);

		//Checks if user has played the round already
		$result = is_null(Result::where('user_id', $user->id)->where('round_id', $round_id)->first());
		if($result) {
			return redirect()->route('results', [$game_id]);
		}

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

		//Return view
		return view("gameloop.round_history", [
			"game_id" => $game_id,
			"questions" => $questions,
			"user" => [
				"object" => $user,
				"answers" => $user_answers,
			],
			"opponent" => [
				"object" => $opponent,
				"answers" => $opponent_answers
			]
		]);
	}
	
	/**
	 * Pick 10 questions from the round's category and store them
	 *
	 * @param  mixed $round
	 * @return void
	 */
	private static function prepareQuestions($round)
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
}