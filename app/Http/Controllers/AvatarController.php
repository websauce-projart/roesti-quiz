<?php

namespace App\Http\Controllers;

use App\Models\Eye;
use App\Models\Pose;
use App\Models\User;
use App\Models\Mouth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{    
    /**
     * Update avatar in BDD, called by other methods in this controller
     *
     * @param  mixed $request
     * @return void
     */
    private static function setAvatar(Request $request) {
        dd($request->all());
        //Retrieve data
        $user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();

        //Update avatar
        $user->mouth_id = $request->mouths;
        $user->eye_id = $request->eyes;
        $user->pose_id = $request->poses;
        $user->save();
    }
    
    /**
     * Create avatar and redirect
     *
     * @param  mixed $request
     * @return redirect to onboardingQuiz route
     */
    public function createAvatar(Request $request) {
        AvatarController::setAvatar($request);
        return redirect()->route('onboardingQuiz');
    }
    
    /**
     * Update avatar and redirect
     *
     * @param  mixed $request
     * @return redirect to profile route
     */
    public function updateAvatar(Request $request) {
        $user_id = Auth::user()->id;
        AvatarController::setAvatar($request);
        return redirect()->route('profile', [$user_id]);
    }
    
    /**
     * Return avatar editor view accessed from profile page
     *
     * @return view profile/update_avatar
     */
    public function displayAvatarEditor() {
        //Retrieve data
        $eyes = Eye::all();
        $mouths = Mouth::all();
        $poses = Pose::all();
        $user_id = Auth::user()->id;
        
        //Return view
        return view('profile/update_avatar')
        ->with('eyes', $eyes)
        ->with('mouths', $mouths)
        ->with('poses', $poses)
        ->with('user_id', $user_id);
    }
    
    /**
     * Return avatar creator view accessed from onboarding page
     *
     * @return view create_avatar
     */
    public function displayAvatarCreator() {
        //Retrieve data
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $eyes = Eye::all();
        $mouths = Mouth::all();
        $poses = Pose::all();

        //Return view
        return view('onboarding/create_avatar')
        ->with('pseudo', $user->pseudo)
        ->with('eyes', $eyes)
        ->with('mouths', $mouths)
        ->with('poses', $poses);
    }
    
    /**
     * Return avatar data to be used in Vue.js components
     *
     * @param  int $user_id
     * @return array contains all the user avatar data
     */
    public function dataAvatar($user_id){
        $user = User::where('id', $user_id)->first();
        $mouth = $user->mouth_id;
        $eye = $user->eye_id;
        $pose = $user->pose_id;
        $data =
            [
                'pseudo' => $user->pseudo,
                'mouth' => $mouth,
                'eye' => $eye,
                'pose' => $pose,
        ];
        return response()->json($data);
    }
} 
