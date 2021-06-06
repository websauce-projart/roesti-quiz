<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Result;
use App\Models\Category;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{

    public function displayQuiz()
    {
        //Retrieve user, round and questions data
        $user_id = Auth::user()->id;
        $round = session("round");
        if(!isset($round)) {
            //Redirect to home if coming from endgame page
            return redirect()->route('home');
        }
        $round_id = $round->id;
        $questions = Round::where('id', $round_id)->first()->questions()->get();

        //Create Result
        $result = Result::create([
            "user_id" => $user_id,
            "round_id" => $round_id
        ]);

        //Send result and questions data to be used in next method
        session(["result" => $result]);
        session(["questions" => $questions]);

        return view('gameloop/quiz')->with('questions', $questions);
    }

    public function handleAnswers(Request $request)
    {
        //Retrieve user, questions and result data
        $user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
        $questions = session('questions');
        $result = session('result');

        //Create UserAnswers for each question
        foreach ($questions as $question) {
            if ($request->has($question->id)) {
                UserAnswer::create([
                    "question_id" => $question->id,
                    "result_id" => $result->id,
                    "user_answer" => 1
                ]);
            } else {
                UserAnswer::create([
                    "question_id" => $question->id,
                    "result_id" => $result->id,
                    "user_answer" => 0
                ]);
            }
        }

        //Calculate how many answers are correct
        $correct_answers_count = 0;
        foreach ($questions as $question) {
            $answer_boolean = $question->answer_boolean;
            $user_answer = $request->has($question->id);
            if($answer_boolean == $user_answer) {
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
        if($results_count != 2) {
            $game = Round::where('id', $round_id)->first()->game;
            $opponent = $user->getOtherUser($game->id);
            $game->active_user_id = $opponent->id;
            $game->save();
        }

        return redirect()->route('endgame')->with(['result' => $result]);
    }

    public function displayEndgame() {
        $result = session('result');

        if(!isset($result)) {
            return redirect()->route('home');
        }

        $round_id = Result::where('id', $result->id)->first()->round()->first()->id;        

        //Count correct answers
        $questions = Round::where('id', $round_id)->first()->questions()->get();
        $correct_answers_count = 0;
        foreach ($questions as $question) {
            $answer_boolean = $question->answer_boolean;
            $user_answer = UserAnswer::where('question_id', $question->id)->where('result_id', $result->id)->first()->user_answer;
            if($answer_boolean == $user_answer) {
                $correct_answers_count++;
            }
        }

        //Retrieve time
        $time = $result->time;

        //Retrieve score
        $score = $result->score;

        //Clean session
        $dataToClean = [
            'round',
            'result',
            'questions'
        ];

        foreach ($dataToClean as $data) {
            if(session()->has($data)) {
                session()->forget($data);
            }
        }
        
        return view('gameloop/endgame')
        ->with('count', $correct_answers_count)
        ->with('time', $time)
        ->with('score', $score);
    }
}
