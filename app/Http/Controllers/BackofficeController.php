<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function showBackofficeView() {
        return view('backoffice/home_backoffice');
    }

    public function displayAddAdminView() {
        return view('backoffice/add_admin');
    }

    public function createAdmin(Request $request) {
        $request->validate([
            'pseudo' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        $user->admin = 1;
        $user->has_onboarded = 1;
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('adminIndex');
    }
}
