<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{

    /********************************
     * Login
     ********************************/

    /**
     * Return login view with form
     * @return view
     **/
    public function showLoginView()
    {
        return view("auth/login");
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            "pseudo" => "required",
            "password" => "required",
        ]);

        $remember = $request->input('remember_token');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // redirect where user usually attempted to go, but on homepage as a fallback
            return redirect()->intended('/protege');
        }

        return back()->withErrors([
            "loginFailed" => true
        ]);
    }

    /********************************
     * Logout
     ********************************/

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

    /********************************
     * Register
     ********************************/

    /**
     * Return register view with form
     * @return view
     **/
    public function showRegisterView()
    {
        return view("auth/register");
    }

    /**
     * Register a user
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = $request->all();
        $user = $this->create($data);

        event(new Registered($user)); //dispatch event to send verification email

        return redirect()->route('login')->with('account-created', '😊 Votre compte a été crée! 😊');
    }

    /**
     * Create a user in the BDD
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data)
    {
        return User::create([
            'pseudo' => $data['pseudo'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }

    /********************************
     * Email verification
     ********************************/

    /**
     * Return verify email notice view
     *
     * @return view
     */
    public function showVerifyEmailView()
    {
        return redirect()->route('login')->withErrors([
            "account-verify" => true
        ]);
    }

    /**
     * Handle requests generated when the user clicks the email verification link
     *
     * @param  mixed $request
     * @return void
     */
    public function handleVerificationEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('login')->with('account-verified', '✔️ Merci d\'avoir confirmé votre adresse email! ✔️');;
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('login')->with('email-resent', '📧 Un nouveau mail de verification vous a été envoyé! 📧');
    }
}
