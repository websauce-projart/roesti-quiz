<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

	/**
	 * Return quiz view if all the requirements are met and create result in BDD
	 *
	 * @param  int $game_id
	 * @param  int $round_id
	 * @return view gameloop/quiz
	 */
	public function showQuizView($game_id, $round_id)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$questions = Round::where('id', $round_id)->first()->questions()->get();
		$round = Round::where('id', $round_id)->first();
		$result = Result::where('user_id', $user_id)->where('round_id', $round_id)->first();
		$game = Game::where('id', $game_id)->first();

		//Checks if round belongs to the game
		if ($round->game()->first()->id != $game_id) {
			return redirect()->route('home');
		}

		//Checks if this user is in the game
		if (!$game->userExistsInGame($user_id)) {
			return redirect()->route('home');
		}

		//Checks if the round is the last in the game
		if ($game->getLastRound()->id != $round_id) {
			return redirect()->route('results', [$game_id]);
		}

		//Checks if the user is the active player
		if ($game->active_user_id !== $user_id) {
			return redirect()->route('results', [$game->id]);
		}

		//Checks if there is not already results for this round for this user
		// if (!is_null($result)) {
		// 	if ($result->UserAnswers()->get()->count() == 0) {	//User left the game before submitting
		// 		return QuizController::handleQuitting($user_id, $round_id, $game_id, $questions);
		// 	}
		// 	return redirect()->route('results', [$game->id]);	//User has played trough the game already
		// }

		//Create Result
		$result = Result::create([
			"user_id" => $user_id,
			"round_id" => $round_id,
			"timestamp_start" => now()
		]);

		//Return Quiz view
		return view('gameloop/quiz', [
			"questions" => $questions,
			"game_id" => $game->id,
			"round_id" => $round->id,
			"result_id" => $result->id
		]);
	}

	/**
	 * Restores consistency in the BDD if the user quits during the quiz, only used in this controller
	 *
	 * @param  int $user_id
	 * @param  int $round_id
	 * @param  int $game_id
	 * @param  array $questions
	 * @return redirect to endgame route
	 */
	private static function handleQuitting($user_id, $round_id, $game_id, $questions)
	{
		$results_count = count(Round::where('id', $round_id)->first()->results()->get());
		if ($results_count != 2) {
			//Retrieve data
			$game = Round::where('id', $round_id)->first()->game;
			$user = User::where('id', $user_id)->first();
			$opponent = $user->getOtherUser($game->id);
			$result = Result::where('user_id', $user_id)->where('round_id', $round_id)->first();

			//Toggle active_user_id
			$game->active_user_id = $opponent->id;
			$game->save();

			//Update Result
			$result->timestamp_end = new Carbon($result->timestamp_start);
			$result->score = 0;
			$result->save();

			//Create false UserAnswers for each question
			foreach ($questions as $question) {
				UserAnswer::create([
					"question_id" => $question->id,
					"result_id" => $result->id,
					"user_answer" => !($question->answer_boolean)
				]);
			}

			//Return redirect
			return redirect()->route('endgame', ['game_id' => $game_id, 'round_id' => $round_id, 'result_id' => $result->id]);
		}
	}

	/**
	 * Create UserAnswers, update game active player and result if all the requirements are met, then redirect to endgame
	 *
	 * @param  Request $request
	 * @param  int $game_id
	 * @param  int $round_id
	 * @param  int $result_id
	 * @return redirect to endgame route
	 */
	public function createAnswers(Request $request, $game_id, $round_id, $result_id)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$result = Result::where('id', $result_id)->first();
		$questions = $result->round()->first()->questions()->get();

		//Checks if the result belongs to the round
		if ($result->round()->first()->id != $round_id) {
			return redirect()->route('home');
		}

		//Checks if the round belongs to the game
		if (Round::where('id', $round_id)->first()->game()->first()->id != $game_id) {
			return redirect()->route('home');
		}

		//Checks if results belong to user
		if ($result->user_id != $user->id) {
			return redirect()->route('home');
		}

		//Checks if result has not already some UserAnswers
		if ($result->UserAnswers()->count() != 0) {
			return redirect()->route('results', [$game_id]);
		}

		//Calculate time to finish the quizz
		$result->timestamp_end = now();
		$result->save();
		$time = $this->getTimeDiff($result);

		//Create UserAnswers for each question
		foreach ($questions as $question) {
			if ($request->has($question->id)) {
				UserAnswer::create([
					"question_id" => $question->id,
					"result_id" => $result_id,
					"user_answer" => 1
				]);
			} else {
				UserAnswer::create([
					"question_id" => $question->id,
					"result_id" => $result_id,
					"user_answer" => 0
				]);
			}
		}

		//Calculate how many answers are correct
		$correct_answers_count = 0;
		foreach ($questions as $question) {
			$answer_boolean = $question->answer_boolean;
			$user_answer = $request->has($question->id);
			if ($answer_boolean == $user_answer) {
				$correct_answers_count++;
			}
		}

		//Calculate and update "score" in Results table
		if($time == 0) {
			$time = 2000;
		}

		$score = round((2000*$correct_answers_count)/$time);

		if ($score > 1000) {
			$score = 1000;
		}
	
		$result->score = $score;
		$result->save();

		//Toggle active_user_id in Games table
		$results_count = count(Round::where('id', $round_id)->first()->results()->get());
		if ($results_count != 2) {
			$game = Round::where('id', $round_id)->first()->game;
			$opponent = $user->getOtherUser($game->id);
			$game->active_user_id = $opponent->id;
			$game->save();
		}

		//Return redirect
		return redirect()->route('endgame', ['game_id' => $game_id, 'round_id' => $round_id, 'result_id' => $result->id])->with(['result' => $result]);
	}

	/**
	 * Return endgame view if all requirements are met
	 *
	 * @param  int $game_id
	 * @param  int $round_id
	 * @param  int $result_id
	 * @return view endgame/loop
	 */
	public function showEndgameView($game_id, $round_id, $result_id)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$result = Result::where('id', $result_id)->first();
		$round_id = $result->round()->first()->id;
		$game = Round::where('id', $round_id)->first()->game;

		//Checks if the result belongs to the round
		if ($result->round()->first()->id != $round_id) {
			return redirect()->route('home');
		}

		//Checks if the round belongs to the game
		if (Round::where('id', $round_id)->first()->game()->first()->id != $game_id) {
			return redirect()->route('home');
		}

		//Checks if results belong to user
		if ($result->user_id != $user->id) {
			return redirect()->route('home');
		}

		//Checks if the round is the last in the game
		if ($game->getLastRound()->id != $round_id) {
			return redirect()->route('results', [$game_id]);
		}

		//Count correct answers
		$questions = Round::where('id', $round_id)->first()->questions()->get();
		$correct_answers_count = 0;
		if (!is_null(UserAnswer::where('result_id', $result_id)->first())) {
			foreach ($questions as $question) {
				$answer_boolean = $question->answer_boolean;
				$user_answer = UserAnswer::where('question_id', $question->id)->where('result_id', $result->id)->first()->user_answer;
				if ($answer_boolean == $user_answer) {
					$correct_answers_count++;
				}
			}
		}

		//Retrieve time
		$time = $this->getTimeDiff($result);

		//Retrieve score
		$score = $result->score;

		//Get announcer sentence
		$sentence = $this->getSentence($score);

		//Return view
		return view('gameloop/endgame')
			->with("round_id", $round_id)
			->with('count', $correct_answers_count)
			->with('time', $time)
			->with('score', $score)
			->with('game', $game)
			->with('sentence', $sentence);
	}

	/**
	 * Return a random sentence according to the user score, only used in this controller
	 *
	 * @param  int $score
	 * @return String $sentence
	 */
	private static function getSentence($score) {

		$defeatSentences = [
			"Tcheu t'es pas en forme !",
			"Ben j'te dis pas bravo !",
			"Ça va le chalet, ou bien ?",
			"Réveille-toi un peu !",
			"T'es sur Soleure ou quoi ?",
			"C'est quoi cette gogne ?",
			"T'es bobet ou bien ?",
			"Tcheu c'te molle…",
			"T'as pecloté là…",
			"Fais un effort nom de bleu !"

		];

		$victorySentences = [
			"Bravo topio !",
			"Tcheu t'es en forme !",
			"T'as triché, avoue !",
			"J'aurais pas mieux fait",
			"T'étais bien vigousse là !",
			"T'es royé ou bien ?!",
			"Je suis déçu en bien !",
			"Alain Berset te félicite !",
			"De bleu de bleu !",
			"Sacré rösti !"
		];

		//Pick a random sentence
		if($score <= 500) {
			$i = array_rand($defeatSentences);
			$sentence = $defeatSentences[$i];
		} else {
			$i = array_rand($victorySentences);
			$sentence = $victorySentences[$i];
		}

		//Return the sentence
		return $sentence;
	}

	/**
	 * Return the time taken to complete the quiz, used only in this controller
	 *
	 * @param  Result $result
	 * @return int $time
	 */
	private static function getTimeDiff(Result $result) {
		$timestamp_start = new Carbon($result->timestamp_start);
		$timestamp_end = new Carbon($result->timestamp_end);
		$time = $timestamp_start->diffInSeconds($timestamp_end);

		return $time;
	}
}
