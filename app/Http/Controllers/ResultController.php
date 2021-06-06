<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RoundController;

class ResultController extends Controller
{

	/**
	 * Get round's score of a user
	 * @param User $user
	 * @param Round $round
	 * @return int User's round score
	 */
	public static function getScore(User $user, Round $round)
	{
		$result = DB::table("results")
			->where("user_id", $user->id)
			->where("round_id", $round->id)
			->first();
		$score = null;
		if ($result) {
			$score = $result->score;
		}
		return $score;
	}


	/**
	 * Show the results view
	 * @param $game_id ID of the game which contains the results
	 * @return view gameloop.results
	 */
	public static function showResultsView($game_id)
	{
		// NOTE: il faudrait probablement prendre l'objet Game plutôt que juste son ID, mais ça dépend si on peut/doit stocker l'objet game dans une session
		$users = GameController::getPlayers($game_id);
		$rounds = RoundController::getRounds($game_id);

		$processedRounds = [];
		foreach ($rounds as $round) {
			$category = RoundController::getCategory($round);

			$results = [];

			foreach ($users as $user) {
				$score = self::getScore($user, $round);
				array_push($results, $score);
			}


			$processedRound = [
				"category" => $category->title,
				"results" => $results
			];
			array_push($processedRounds, $processedRound);
		}

		return view(
			"gameloop.results",
			[
				"users" => $users,
				"rounds" => $processedRounds
			]
		);
	}
}
