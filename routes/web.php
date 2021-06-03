<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect()->route('login');
});
Route::group(['middleware' => ['verified']], function () {
    

/********************************
 * Home
 ********************************/

Route::get('/home', [GameController::class, 'displayHome'])->name('home');
Route::post('/newgame', [UserController::class, 'displaySearch']);
Route::post('/THOMAS', [GameController::class, 'store']);


/********************************
 * Game loop
 ********************************/
Route::get('/games', [GameController::class, 'displayGames']); //Route de tests
Route::resource('question', QuestionController::class);

});
/********************************
 * Login & Registration
 ********************************/
//Register
Route::get("/register", [AuthController::class, "showRegisterView"])->name('register');
Route::post("/register", [AuthController::class, "register"]);


//Email confirmation
Route::get("/verify", [AuthController::class, "showVerifyEmailView"])
->middleware('auth')->name('verification.notice');

Route::get('/login/{id}/{hash}', [AuthController::class, "handleVerificationEmail"])
->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])
->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

//Login
Route::get("/login", [AuthController::class, "showLoginView"])->name('login');
Route::post("/login", [AuthController::class, "authenticate"]);

//Logout
Route::get("/logout", [AuthController::class, "logout"])->name('logout');;

//Password reset
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordView'])
->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendPasswordEmail'])
->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'handleResetForm']);

/********************************
 * Routes accessible only by admin users 
 ********************************/

Route::group(['middleware' => ['admin']], function () {
    Route::get('/backoffice', function () {
        return view('backoffice/home_backoffice');
    });
    Route::resource('/backoffice/question', QuestionController::class);
    Route::resource('/backoffice/user', UserController::class);
});

