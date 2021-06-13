<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
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
     * Display a listing of the questions.
     *
     * @return view backoffice/list_question
     */
    public function index()
    {
        //Retrieve data
        $questions = Question::all();

        //Return view
        return view('backoffice/list_question')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new question.
     *
     * @return view backoffice/add_question
     */
    public function create()
    {
        //Retrieve data
        $data = Category::all();

        //Return view
        return view('backoffice/add_question')->with('data', $data);
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  QuestionRequest  $request
     * @return redirect to questions.index route
     */
    public function store(QuestionRequest $request)
    {
        //If checkbox is unchecked, question is true
        if ($request->answer_boolean == 1) {
            $answer_boolean = 0;
        } else {
            $answer_boolean = 1;
        };

        //If question is true, wipe recieved answer_label
        if ($answer_boolean == 1) {
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
        return redirect()->route('questions.index')->withOk("La question #" . $question->id . " a été créée.");
    }

    /**
     * Show the form for editing the specified question.
     *
     * @param  int $id
     * @return view backoffice/edit_question
     */
    public function edit($id)
    {
        //Retrieve data
        $question = Question::FindOrFail($id);
        $categories = Category::all();

        //Return view
        return view('backoffice/edit_question', compact('question'))->with('categories', $categories);
    }

    /**
     * Update the specified question in storage.
     *
     * @param  QuestionRequest  $request
     * @param  int  $id
     * @return redirect to questions.index route
     */
    public function update(QuestionRequest $request, $id)
    {
        //Retrieve data
        Question::findOrFail($id)->update($request->all());

        //Return view
        return redirect()->route('questions.index')->withOk("La question #" . $id . " a été modifiée.");
    }

    /**
     * Remove the specified question from storage.
     *
     * @param  int  $id
     * @return redirect to questions.index route
     */
    public function destroy($id)
    {
        //Retrieve data
        Question::findOrFail($id)->delete();

        //Return view
        return redirect()->route('questions.index')->withOk("La question #" . $id . " a été modifiée.");
    }

    //À SUPPRIMER SI UTILISÉE NULLE PART !!!!
    // public function getCategories()
    // {
    //     return Category::all();
    // }
}