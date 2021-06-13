<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordForgotRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{

    /********************************
     * Login
     ********************************/

    /**
     * Return login view with form
     * @return view auth/login
     **/
    public function showLoginView()
    {
        return view("auth/login");
    }

    /**
     * Handle an authentication attempt
     *
     * @param  LoginRequest  $request
     * @return redirect to login or home route
     */
    public function authenticate(LoginRequest $request)
    {
        //Retrieve data
        $pseudo = $request->pseudo;
        $password = $request->password;
        $remember = $request->input('remember_token');

        //User used either email or username
        if (filter_var($pseudo, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            Auth::attempt(['email' => $pseudo, 'password' => $password], $remember);
        } else {
            //user sent their username 
            Auth::attempt(['pseudo' => $pseudo, 'password' => $password], $remember);
        }

        //Was any of those correct ?
        if (Auth::check()) {
            $request->session()->regenerate();

            //User logged in, gets redirected to home
            return redirect()->route('home');
        }

        //Nope, something wrong during authentication 
        return redirect()->route('login')->withError('Les informations de connexion saisies sont incorrectes.');
    }

    /********************************
     * Logout
     ********************************/

    /**
     * Logout and redirect to homepage
     * 
     * @param  Request  $request
     * @return redirect to login route
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /********************************
     * Register
     ********************************/

    /**
     * Return register view with form
     * @return view auth/register
     **/
    public function showRegisterView()
    {
        return view("auth/register");
    }

    /**
     * Register a user and redirect to login
     *
     * @param  UserCreateRequest $request
     * @return redirect to login route
     */
    public function register(UserCreateRequest $request)
    {
        //Retrieve data
        $data = $request->all();
        $user = $this->create($data);

        //Dispatch event to send verification email
        event(new Registered($user)); 

        //Return redirect
        return redirect()->route('login')->withOk('Votre compte a été crée.');
    }

    /**
     * Create a user in the BDD
     *
     * @param  array $data
     * @return User the created user
     */
    public function create($data)
    {
        //Create user
        $user = User::create([
            'pseudo' => $data['pseudo'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        //Add default avatar
        $user->pose_id = 1;
        $user->mouth_id = 1;
        $user->eye_id = 1;
        $user->save();

        //Return user
        return $user;
    }

    /********************************
     * Email verification
     ********************************/

    /**
     * Return verify email notice view
     *
     * @return view auth/verify
     */
    public function showVerifyEmailView()
    {
        return view("auth/verify");
    }

    /**
     * Handle requests generated when the user clicks the email verification link
     *
     * @param  EmailVerificationRequest $request
     * @return redirect to login route
     */
    public function handleVerificationEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home');
    }

    /**
     * Resend a verification email
     *
     * @param  Request $request
     * @return redirect to verify route
     */
    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice')->withOk('Un nouveau mail de vérification vous a été envoyé!');
    }


    /********************************
     * Password forgot
     ********************************/

    /**
     * Return forgot password view with form to enter an email
     *
     * @return view auth/forgot_password
     */
    public function showForgotPasswordView()
    {
        return view("auth/forgot_password");
    }

    /**
     * Send a email to reset password to the specified email
     *
     * @param  PasswordForgotRequest $request
     * @return redirect to login route
     */
    public function sendPasswordEmail(PasswordForgotRequest $request)
    {
        //Send a email containing reset a password link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        //Return on forgot_password with with status message
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->with(['email' => __($status)]);
    }

    /**
     * Return reset password view with a form to enter a new password
     *
     * @param  mixed $token
     * @return view auth/reset_password
     */
    public function showResetForm($token)
    {
        return view('auth/reset_password', ['token' => $token]);
    }

    /**
     * Handle the reset password form, validate the request and update the password
     *
     * @param  PasswordResetRequest $request
     * @return redirect to login route
     */
    public function handleResetForm(PasswordResetRequest $request)
    {
        //Update the password
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

        //Return with status message
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->withOk($status)
            : back()->with(['email' => __($status)]);
    }

    /********************************
     * Password update
     ********************************/

    /**
     * Return update password view
     *
     * @return view profile/update_password
     */
    public function showUpdatePassword()
    {
        return view('profile/update_password');
    }

    /**
     * User changing his password in his profile. Validate the old and new password, if matching and updates the database.
     *
     * @param  PasswordUpdateRequest $request
     * @return redirect back
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        //Retrieve actual password
        $hashedPassword = Auth::user()->password;

        //Validate new password and return with status message
        if (Hash::check($request->oldpassword, $hashedPassword)) {

            if (!Hash::check($request->newpassword, $hashedPassword)) {
                $user_id = Auth::user()->id;
                $user = User::where('id', $user_id)->first();
                $user->password = $request->newpassword;
                $user->save();
                return redirect()->back()->withOk('Le mot de passe a été changé avec succès !');
            } else {
                return redirect()->back()->withError('Le nouveau mot de passe doit être différent de l\'ancien !');
            }
        } else {
            return redirect()->back()->withError('L\'ancien mot de passe n\'est pas le bon.');
        }
    }
}
