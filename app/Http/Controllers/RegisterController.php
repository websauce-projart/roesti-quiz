<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class RegisterController extends Controller
{
    //Inspiré de :
    //https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/

    /**
	 * Return register view with form
	 * @return view
	 **/
	public function showRegisterView()
	{
		return view("register");
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
        
        return redirect("/")->withSuccess('😊 Votre compte a été crée! 😊');
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
    
    //Doc vérification email:
    //https://laravel.com/docs/8.x/verification

    /**
     * Return verify email notice view
     *
     * @return view
     */
    public function showVerifyEmailView() {
      return view('verify_email');
    }

        
    /**
     * Handle requests generated when the user clicks the email verification link
     *
     * @param  mixed $request
     * @return void
     */
    public function handleVerificationEmail(EmailVerificationRequest $request) {
      $request->fulfill();
      return redirect('/')->with('verify', '✔️ Merci d\'avoir confirmé votre adresse email! ✔️');;
    }

    public function resendVerificationEmail(Request $request) {
      $request->user()->sendEmailVerificationNotification();
      return back()->with('resent', 'Un nouveau mail de verification vous a été envoyé!');
    }
}