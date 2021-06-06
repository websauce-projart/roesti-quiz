<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RoundController;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use Illuminate\Http\Request;

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
	public static function showResultsView()
	{
		$gameToRetrieve = session('game');
		if(!isset($gameToRetrieve)) {
			return redirect()->route('home');
		}
		$game_id = $gameToRetrieve->id;
		

		$game = Game::where('id', $game_id)->first();
		$user = User::where('id', Auth::user()->id)->first();
		// dd($user);
		$opponent = $user->getOtherUser($game_id);
		$users = [$user, $opponent];
		$rounds = RoundController::getRounds($game_id);

		$processedRounds = [];
		foreach ($rounds as $round) {
			$category = RoundController::getCategory($round);

			$results = [];

			foreach ($users as $player) {
				$score = self::getScore($player, $round);
				array_push($results, $score);
			}

			$processedRound = [
				"category" => $category->title,
				"results" => $results
			];
			array_push($processedRounds, $processedRound);
		}

		return view('gameloop/results')->with([
			"game" => $game,
			"user" => $user,
			"opponent" => $opponent,
			"rounds" => $processedRounds
		]);
	}

	public function redirectToResult(Request $request) {
		$user = User::where('id', Auth::user()->id)->first();
		$game = Game::where('id', $request->game_id)->first();
		$isCorrectUser = false;
		$players = $game->users()->get();
		foreach ($players as $player) {
			if($player->id == $user->id) {
				$isCorrectUser = true;
			}
		}
		if($isCorrectUser) {
			if(!$game->active_user_id == $user->id) {return redirect()->route('home');}
			$round = Round::where('game_id', $game->id)->orderBy('created_at', 'DESC')->first();
			
			$results = Result::where('round_id', $round->id)->get();
			if(count($results) >= 2) {
				session(['game' => $game]);
				// return redirect()->route('category');
				return CategoryController::displayCategoryView();
			}
			session(['round' => $round]);
			session(['game' => $game]);
			return redirect()->route('results');
		}
		
	}
}
