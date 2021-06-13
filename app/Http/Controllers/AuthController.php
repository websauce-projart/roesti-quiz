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
     * @return view login
     **/
    public function showLoginView()
    {
        return view("auth/login");
    }

    /**
     * Handle an authentication attempt
     *
     * @param  \Illuminate\Http\Request  $request
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
        return redirect()->route('login')->withErrors([
            "login-failed" => true
        ]);
    }

    /********************************
     * Logout
     ********************************/

    /**
     * Logout and redirect to homepage
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
     * @return view register
     **/
    public function showRegisterView()
    {
        return view("auth/register");
    }

    /**
     * Register a user and redirect to login
     *
     * @param  mixed $request
     * @return redirect to login route
     */
    public function register(UserCreateRequest $request)
    {
        $data = $request->all();
        $user = $this->create($data);

        event(new Registered($user)); //dispatch event to send verification email
        return redirect()->route('login');
    }

    /**
     * Create a user in the BDD
     *
     * @param  mixed $data
     * @return User
     */
    public function create(array $data)
    {
        $user = User::create([
            'pseudo' => $data['pseudo'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->pose_id = 1;
        $user->mouth_id = 1;
        $user->eye_id = 1;
        $user->save();

        return $user;
    }

    /********************************
     * Email verification
     ********************************/

    /**
     * Return verify email notice view
     *
     * @return view verify
     */
    public function showVerifyEmailView()
    {
        return view("auth/verify");
    }

    /**
     * Handle requests generated when the user clicks the email verification link
     *
     * @param  mixed $request
     * @return redirect to login route
     */
    public function handleVerificationEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('login');
    }

    /**
     * Resend a verification email
     *
     * @param  mixed $request
     * @return redirect to verify route
     */
    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice')->withErrors(['email-resent' => true]);
    }


    /********************************
     * Password forgot
     ********************************/

    /**
     * Return forgot password view with form to enter an email
     *
     * @return view forgot_password
     */
    public function showForgotPasswordView()
    {
        return view("auth/forgot_password");
    }

    /**
     * Send a email to reset password to the specified email
     *
     * @param  mixed $request
     * @return redirect to login
     */
    public function sendPasswordEmail(PasswordForgotRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Return reset password view with a form to enter a new password
     *
     * @param  mixed $token
     * @return view reset_password
     */
    public function showResetForm($token)
    {
        return view('auth/reset_password', ['token' => $token]);
    }

    /**
     * Handle the reset password form, validate the request and update the password
     *
     * @param  mixed $request
     * @return redirect to login route
     */
    public function handleResetForm(Request $request)
    {
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

    /********************************
     * Password update
     ********************************/

    /**
     * Return update password view
     *
     * @return view update_password
     */
    public function showUpdatePassword()
    {
        return view('profile/update_password');
    }

    /**
     * User changing his password in his profile. Validate the old and new password, if matching and updates the database.
     *
     * @param  mixed $request
     * @return redirect to login route
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {

            if (!Hash::check($request->newpassword, $hashedPassword)) {
                $user_id = Auth::user()->id;
                $user = User::where('id', $user_id)->first();
                $user->password = $request->newpassword;
                $user->save();
                session()->flash('message', 'Le mot de passe a été changé avec succès !');
                return redirect()->back();
            } else {
                session()->flash('message', 'Le nouveau mot de passe doit être différent de l\'ancien !');
                return redirect()->back();
            }
        } else {
            session()->flash('message', 'L\'ancien mot de passe n\'est pas le bon ...');
            return redirect()->back();
        }
    }
}
