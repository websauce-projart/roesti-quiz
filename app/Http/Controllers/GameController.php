<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Category;
use App\Models\Result;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewGameRequest;

class GameController extends Controller
{

	/**
	 * Store a newly created game in storage.
	 *
	 * @param Request $request
	 * @return redirect to categories or results route
	 */
	public function createGame(NewGameRequest $request)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$opponent = User::where('pseudo', $request->user)->first();
		
		//Checks if game exists already
		if(Game::isExistingAlready($user, $opponent)) {
			$game = Game::getGameFromUsers($user, $opponent);
			$round_count = $game->rounds()->get()->count();

			//If user created a game but left before choosing a category
			if($round_count == 0) {
				return redirect()->route('category', [$game]);
			}

			//If at least a round exists already
			if($round_count > 0) {
				return redirect()->route('results', [$game]);
			}
		};
		
		//Create game
		$game = Game::create(['active_user_id' => $user->id]);
		$game->users()->attach($user->id);
		$game->users()->attach($opponent->id);

		//Redirect to categories
		return redirect()->route('category', [$game]);		
	}
	
	/**
	 * Return the category view with 3 random categories
	 *
	 * @param  int $game_id
	 * @return view gameloop/categories
	 */
	public static function displayCategoryView($game_id)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$game = Game::where('id', $game_id)->first();

		//Checks that the user is the active user in game
		if ($game->active_user_id !== $user_id) {
			return redirect()->route('home');
		}

		if (!is_null($game->getLastRound())) {
			$last_round = $game->getLastRound();
			$results_count = $last_round->results()->get()->count();

			//User choose the category and created the round but left before doing the quizz
			if ($results_count == 0) {
				return redirect()->route('results', [$game]);
			}

			//The current round is not over, user shouldn't choose a category
			if ($results_count !== 2) {
				return redirect()->route('home');
			}
		}

		//Get 3 random categories
		$rounds = Round::where('game_id', $game_id)->get();
		$round_count = $rounds->count();
		$categories = Category::getRandomCategories($round_count, $game_id, $user_id);

		//Return view
		return view('gameloop/choose_categories')
			->with('categories', $categories)
			->with('data', $game_id);
	}

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

	/**
	 * Pick 10 questions from the round's category and store them, only used in this controller
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
	 * Redirect the user from the results page to where he needs to go according to the game state
	 *
	 * @param  int $game_id
	 * @return redirect to home, category or quiz route
	 */
	public function redirectFromResults($game_id)
	{
		//Retrieve data
		$game = Game::where('id', $game_id)->first();
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();

		//Checks if user belongs to the game
		if (!$game->userExistsInGame($user->id)) {
			return redirect()->route('home');
		}

		//Checks if user is the active user in game
		if ($game->active_user_id != $user->id) {
			return redirect()->route('home');
		}

		//User come from results and either
		$round = $game->getLastRound();
		$results_count = $round->results()->get()->count();

		if ($results_count == 2) {
			//just ended the round and now must choose a new category
			return redirect()->route('category', [$game]);

		} else if ($results_count == 0 || $results_count == 1) {
			//start the round
			return redirect()->route('quiz', ['game_id' => $game->id, 'round_id' => $round->id]);
		}
	}
	
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
		$questions = $round->questions()->get();

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

}
