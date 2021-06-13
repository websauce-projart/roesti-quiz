<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class OnboardingController extends Controller
{    
    /**
     * Return onboarding welcome view
     *
     * @return view onboarding/welcome
     */
    public function displayWelcome() {
        //Return view
        return view('/onboarding/welcome');
    }
        
    /**
     * Return onboarding quiz tutorial view
     *
     * @return view onboarding/quiz
     */
    public function displayQuizTutorial() {
        //Return view
        return view('/onboarding/quiz');
    }
    
    /**
     * Return onboarding history tutorial view
     *
     * @return view onboarding/history
     */
    public function displayHistoryTutorial () {
        //Return view
        return view('/onboarding/history');
    }
    
    /**
     * Return onboarding friends tutorial view
     *
     * @return view onboarding/friends
     */
    public function displayFriendsTutorial() {
        //Retrieve data
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        //Toggle has_onboarded
        $user->has_onboarded = true;
        $user->save();

        //Return view
        return view('/onboarding/friends');
    }
}