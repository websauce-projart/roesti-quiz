<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

	/**
	 * Return login view with form
	 * @return view
	 **/
	public function showLoginView()
	{
		return view("login");
	}

	/**
	 *
	 */
	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate(); // pas sûr ?
		$request->session()->regenerateToken(); // lié au remember_me ?
		return redirect("/");
	}

	/**
	 * Handle an authentication attempt.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function authenticate(Request $request)
	{

		$credentials = $request->validate([
			"pseudo" => "required",
			"password" => "required",
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate(); // ça sert à quoi ?

			return redirect()->intended('/'); // renvoit sur l'url initialement désirée, mais renvoit sur l'uri précisée en arugment comme fallback
		}

		return back()->withErrors([
			"loginFailed" => ["Désolé, le pseudo ou le mot de passe n'est pas correct"]
		]);
	}
}
