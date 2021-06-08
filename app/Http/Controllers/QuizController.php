<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Result;
use App\Models\UserAnswer;
use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    public function showQuizView($round_id)
    {
        //Retrieve data
        $user_id = Auth::user()->id;
        $round = Round::where('id', $round_id)->first();
        $game = $round->game()->first();

        //Checks if this user is in this game, is the active player, and have no result for this round, else redirect to home
        // -- TO IMPLEMENT
        
        
        //Create Result
        $result = Result::create([
            "user_id" => $user_id,
            "round_id" => $round_id
        ]);

        //Retrieve questions to send
        $questions = $round->questions()->get();

        //Return Quiz view
        return view('gameloop/quiz')
        ->with('questions', $questions)
        ->with('result_id', $result->id);
    }

    public function createAnswers(Request $request, $result_id)
    {
        //Retrieve data
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $result = Result::where('id', $result_id)->first();
        $questions = $result->round()->first()->questions()->get();

        //Checks if results belong to user and if result has not already some UserAnswers, else redirect
        if($result->user_id != $user->id || $result->UserAnswers()->count() != 0) {
            return redirect()->route('home');
        }

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

        //Retrieve created_at et updated_at from Result and substract to find how many time the user needed for the quiz
        //and update "time" in Results table
        //todo....
        $time = 10;
        $result->time = $time;
        $result->save();

        //Calculate and update "score" in Results table
        $score = $correct_answers_count * $time;
        $result->score = $score;
        $result->save();

        //Toggle active_user_id in Games table
        $round_id = $result->round_id;
        $results_count = count(Round::where('id', $round_id)->first()->results()->get());
        if ($results_count != 2) {
            $game = Round::where('id', $round_id)->first()->game;
            $opponent = $user->getOtherUser($game->id);
            $game->active_user_id = $opponent->id;
            $game->save();
        }

        return redirect()->route('endgame', [$result->id])->with(['result' => $result]);
    }

    public function showEndgameView($result_id)
    {
        //Retrieve data
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $result = Result::where('id', $result_id)->first();
        $round_id = $result->round()->first()->id;
        $game = Round::where('id', $round_id)->first()->game;

        //Checks if result belongs to user
        if($result->user_id != $user->id) {
            return redirect()->route('home');
        }

        //Count correct answers
        $questions = Round::where('id', $round_id)->first()->questions()->get();
        $correct_answers_count = 0;
        foreach ($questions as $question) {
            $answer_boolean = $question->answer_boolean;
            $user_answer = UserAnswer::where('question_id', $question->id)->where('result_id', $result->id)->first()->user_answer;
            if ($answer_boolean == $user_answer) {
                $correct_answers_count++;
            }
        }

        //Retrieve time
        $time = $result->time;

        //Retrieve score
        $score = $result->score;

        return view('gameloop/endgame')
            ->with('count', $correct_answers_count)
            ->with('time', $time)
            ->with('score', $score)
            ->with('game', $game);
    }

    public function redirectFromResults($game_id)
    {
        //If user doesn't belongs to this game, get redirects
        $game = Game::where('id', $game_id)->first();
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if (!$game->userExistsInGame($user->id)) {
            return redirect()->route('home');
        }

        //User come from results and either:
        $round = $game->getLastRound();
        $results_count = $round->results()->get()->count();

        if ($results_count == 2) {
            dd('routecateg - pas checké');  //À CHECKER!!!!
            //just ended the round and now must choose a new category
            return redirect()->route('category');

        } else if ($results_count == 0)
            //start the round
            return redirect()->route('quiz', ['round_id' => $round->id]);
    }
}
