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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('backoffice/list_question')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getCategories();
        return view('backoffice/add_question')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        //If checkbox is unchecked, question is true
        if($request->answer_boolean == 1){
            $answer_boolean = 0;
        } else {
            $answer_boolean = 1;
        };

        //If question is true, wipe recieved answer_label
        if($answer_boolean == 1) {
            $answer_label = null;
        } else {
            $answer_label = $request->answer_label;
        }

        //Process data
        $user_id = Auth::user()->id;
        $response = [
            'label' => $request->label,
            'answer_label' => $answer_label,
            'answer_boolean' => $answer_boolean,
            'author_id' => $user_id,
        ];

        //Create question
        $question = Question::create($response);
        $question->categories()->attach($request->categories);

        //Return redirect
        return redirect()->route('questions.index')->withOk("La question #" . $question->id ." a été créée.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::FindOrFail($id);
        $categories = Category::all();
        return view('backoffice/edit_question', compact('question'))->with('categories', $categories);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        Question::findOrFail($id)->update($request->all());
        return redirect()->route('questions.index')->withOk("La question #" . $id ." a été modifiée.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->route('questions.index')->withOk("La question #" . $id ." a été modifiée.");
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
