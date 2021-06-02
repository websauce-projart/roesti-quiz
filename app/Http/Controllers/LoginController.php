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
	 * Logout and redirect to homepage
	 * @return redirect
	 */
	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
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
			$request->session()->regenerate();

			// redirect where user usually attempted to go, but on homepage as a fallback
			return redirect()->intended('/');
		}

		return back()->withErrors([
			"loginFailed" => true
		]);
	}
}
