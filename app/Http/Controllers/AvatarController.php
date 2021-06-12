<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Eye;
use App\Models\Mouth;
use App\Models\Pose;

class AvatarController extends Controller
{
    private static function setAvatar(Request $request) {
        $user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
        $user->mouth_id = $request->mouths;
        $user->eye_id = $request->eyes;
        $user->pose_id = $request->poses;
        $user->save();
    }

    public function displayAvatarEditor() {
        $eyes = Eye::all();
        $mouths = Mouth::all();
        $poses = Pose::all();
        
        return view('profile/update_avatar')
        ->with('eyes', $eyes)
        ->with('mouths', $mouths)
        ->with('poses', $poses);
    }

    public function createAvatar(Request $request) {
        AvatarController::setAvatar($request);
    }

    public function updateAvatar(Request $request) {
        AvatarController::setAvatar($request);
        return redirect()->route('profile');
    }

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
