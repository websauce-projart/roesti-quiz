<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AvatarController extends Controller
{
    //TO DELETE
    // public function setAvatar(Request $request) {
    //     $user_id = Auth::user()->id;
	// 	$user = User::where('id', $user_id)->first();
    //     $user->bouche = $request->mouth;
    //     $user->yeux = $request->eye;
    //     $user->couleur = $request->color;
    //     $user->save();

    //     return redirect()->route('home');
    // }

    public function displayAvatarEditor() {
        return view('avatar/avatar');
    }
}
