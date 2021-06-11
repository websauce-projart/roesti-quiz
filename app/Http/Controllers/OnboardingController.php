<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class OnboardingController extends Controller
{
    public function displayWelcome() {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        //Checks if user has already onboarded
        //TO IMPLEMENT

        //Toggle has_onboarded and return view
        $user->has_onboarded = true;
        $user->save();

        return view('/onboarding/welcome');
    }

    public function displayAvatarCreator() {
        
    }
}
