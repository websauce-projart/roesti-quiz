<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Round;
use App\Models\Category;

class QuizController extends Controller
{
    public function getQuestions($round_id = 1)
    {
        $round = Round::where('id', $round_id)->first();



        $questionsTab = array();
        for ($i = 0; $i < 10; $i++) {
            // $question = Question::wherePivot('category_id', $round->category_id)->first();
            // $question = Question::find(1)->categories()->first();
            // $questions = Category::all()->questions()->where('category_id', 1)->first();
            // $questions = Category::all()->questions;
            // $questions = Category::where('category_id', 1)->get();
            // $questions = Question::all();
            // $filteredQuestions = array();
            foreach($questions as $question) {
                // dd($question->wherePivot('category_id', 1)->first());
                dd($question->wherePivot('category_id', 1)->first());

                array_push($filteredQuestions, $question->wherePivot('category_id', 1)->first());
                // if($question->categories->id);
            }

            // $past = $department->users()
            //     ->wherePivot('term_end_date', '<', '2017-10-10')
            //     ->get(); // execute the query

            // $questions = Question::wherePivot('category_id', '=', 1)->get();

            dd($questions);
            array_push($questionsTab, $question);
        }
        dd($questionsTab);
    }
}
