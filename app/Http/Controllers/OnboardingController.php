<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class OnboardingController extends Controller
{
    public function displayWelcome() {
        //Return view
        return view('/onboarding/welcome');
    }
    
    public function displayQuizTutorial() {
        //Return view
        return view('/onboarding/quiz');
    }

    public function displayHistoryTutorial () {
        //Return view
        return view('/onboarding/history');
    }

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
