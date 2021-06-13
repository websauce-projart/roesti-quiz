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

class ResultController extends Controller
{

	// À SUPPRIMER SI UTILISÉE NULLE PART !!!!
	// /**
	//  * Return round's score of a user
	//  * @param User $user
	//  * @param Round $round
	//  * @return int User's round score
	//  */
	// public static function getScore(User $user, Round $round)
	// {
	// 	$result = DB::table("results")
	// 		->where("user_id", $user->id)
	// 		->where("round_id", $round->id)
	// 		->first();
	// 	$score = null;
	// 	if ($result) {
	// 		$score = $result->score;
	// 	}
	// 	return $score;
	// }


	/**
	 * Return the results view
	 * @param $game_id ID of the game which contains the results
	 * @return view gameloop/results
	 */
	public static function showResultsView($game_id)
	{
		//Retrieve data
		$game = Game::where('id', $game_id)->first();
		$user_id = Auth::user()->id;

		//Checks if game exists
		if(is_null($game)) {
			return redirect()->route('home');
		}

		//Checks if the user is in the game
		if (!$game->userExistsInGame($user_id)) {
			return redirect()->route('home');
		}

		//Checks if there is at least one round in the game
		if (is_null($game->getLastRound())) {
			return redirect()->route('home');
		}

		//Retrieve data
		$user = User::where('id', $user_id)->first();
		$opponent = $user->getOtherUser($game_id);		
		$rounds = $game->getAllRounds();
		$lastRound = $rounds->sortByDesc('id')->first();

		//Calculate score
		$userWonRounds = 0;
		$opponentWonRounds = 0;
		foreach($rounds as $round) {
			if($round->results()->get()->count() == 2) {
				if($user->getScore($round->id) == $opponent->getScore($round->id)) {
					$userWonRounds += 1;
					$opponentWonRounds += 1;
				} else if ($user->getScore($round->id) > $opponent->getScore($round->id)) {
					$userWonRounds += 1;
				} else {
					$opponentWonRounds += 1;
				}
			}
		}

		//Return view
		return view('gameloop/results')->with([
			"game" => $game,
			"user" => $user,
			"userWonRounds" => $userWonRounds,
			"opponent" => $opponent,
			"opponentWonRounds" => $opponentWonRounds,
			"rounds" => $rounds->reverse(),
			"lastRound" => $lastRound
		]);
	}
	
	/**
	 * Redirect the user from the home page to where he needs to go according to the game state
	 *
	 * @param  Request $request
	 * @return redirect to home, category or results route
	 */
	public function redirectFromHome(Request $request)
	{
		$user = User::where('id', Auth::user()->id)->first();
		$game = Game::where('id', $request->game_id)->first();
		$players = $game->users()->get();

		//If the player doesn't belong to the game -> redirected to home
		if (!$players->contains($user)) {
			return redirect()->route('home');
		}

		//If the game has no rounds created -> redirected to home
		$round = Round::where('game_id', $game->id)->orderBy('created_at', 'DESC')->first();
		if(is_null($round)) {
			return redirect()->route('category', [$game]);
		}

		//If the player isn't the active player -> redirected to home
		if ($game->active_user_id !== $user->id) {
			return redirect()->route('results', [$game]);
		}

		//If the user is the active player:
		$results = Result::where('round_id', $round->id)->get();
		if (count($results) >= 2) {
			//The game has more than 2 results, so the user is the one choosing the category
			return redirect()->route('category', [$game]);

		} else {
			//The category has already been chosen, the user go the results and play
			return redirect()->route('results', [$game]);
		}
	}
}
