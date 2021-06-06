<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
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
     * Handle an authentication attempt
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        Validator::make($request->all(), [
            "pseudo" => "required",
            "password" => "required",
        ])->validate();

        $pseudo = $request->pseudo;
        $password = $request->password;
        $remember = $request->input('remember_token');

        if (filter_var($pseudo, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            Auth::attempt(['email' => $pseudo, 'password' => $password], $remember);
        } else {
            //they sent their username instead 
            Auth::attempt(['pseudo' => $pseudo, 'password' => $password], $remember);
        }

        //was any of those correct ?
        if (Auth::check()) {
            $request->session()->regenerate();
            // redirect where user usually attempted to go, but on homepage as a fallback
            return redirect()->intended('/home');
        }

        //Nope, something wrong during authentication 
        return redirect()->route('login')->withErrors([
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
        
        $user->eye_id = 1;
        $user->mouth_id = 1;
        $user->pose_id = 1;
        $user->save();


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
            'password' => $data['password'],
            'eye_id' => 1,
            'mouth_id' => 1,
            'pose_id' => 1
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


    /********************************
     * Password reset
     ********************************/
    public function showForgotPasswordView() {
        return view("auth/forgot_password");
    }

    public function sendPasswordEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token) {
        return view('auth/reset_password', ['token' => $token]);
    }

    public function handleResetForm(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
