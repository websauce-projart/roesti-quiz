<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\CategoryController;

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
		//Checks if the user is in the game and that there is at least one round
		$game = Game::where('id', $game_id)->first();
		$user_id = Auth::user()->id;

		if (!$game->userExistsInGame($user_id)) {
			return redirect()->route('home');
		}

		if (is_null($game->getLastRound())) {
			return redirect()->route('home');
		}



		//Retrieve data
		$user = User::where('id', $user_id)->first();
		$opponent = $user->getOtherUser($game_id);
		$users = [$user, $opponent];
		$rounds = RoundController::getRounds($game_id);
		$lastRound = $rounds->sortByDesc('id')->first();


		$processedRounds = [];
		foreach ($rounds as $round) {
			$category = RoundController::getCategory($round);

			$results = [];

			foreach ($users as $player) {
				$score = self::getScore($player, $round);
				array_push($results, $score);
			}

			$processedRound = [
				"id" => $round->id,
				"category" => $category->title,
				"results" => $results
			];
			array_push($processedRounds, $processedRound);
		}

		return view('gameloop/results')->with([
			"game" => $game,
			"user" => $user,
			"opponent" => $opponent,
			"rounds" => $processedRounds,
			"lastRound" => $lastRound
		]);
	}

	public function redirectFromHome(Request $request)
	{
		$user = User::where('id', Auth::user()->id)->first();
		$game = Game::where('id', $request->game_id)->first();
		$players = $game->users()->get();

		//The user isn't in the game, he gets redirected	-- à tester
		if (!$players->contains($user)) {
			return redirect()->route('home');
		}

		//Tester si la game n'a pas de round
		$round = Round::where('game_id', $game->id)->orderBy('created_at', 'DESC')->first();
		if(is_null($round)) {
			return redirect()->route('category', [$game]);
		}

		//The user isn't the active player, he go to the results	-- à tester
		if ($game->active_user_id !== $user->id) {
			return redirect()->route('results', [$game]);
		}

		//The user is the active player
		$results = Result::where('round_id', $round->id)->get();

		if (count($results) >= 2) {
			//The user is the one choosing the category		-- à tester
			return redirect()->route('category', [$game]);
		} else {
			//The category has already been chosen, the user go the results and play	-- à tester
			return redirect()->route('results', [$game]);
		}
	}
}
