<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createQuestion(QuestionRequest $request)
    {
        //If checkbox is unchecked, question is true
        if($request->answer_boolean == null){
            $request->answer_boolean = 1;
        };

        //Process data
        $user_id = Auth::user()->id;
        $response = [
            'label' => $request->label,
            'answer_label' => $request->answer_label,
            'answer_boolean' => $request->answer_boolean,
            'author_id' => $user_id,
        ];

        //Create question
        $question = Question::create($response);
        $question->categories()->attach($request->categories);

        //Return redirect
        return redirect()->route('addQuestion')->withOk("La question a été créée.");
    }

    /**
     * Display a listing of questions.
     *
     * @return view list_question
     */
    public function indexQuestion()
    {
        $questions = Question::all();
        return view('backoffice/list_question')->with('questions', $questions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function displayAddQuestionView() {
        $data = $this->getCategories();
        return view('backoffice/add_question')->with('data', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
        return Category::all();
    }
}
