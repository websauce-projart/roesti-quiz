<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

/********************************
 * Home
 ********************************/

Route::get('/', [GameController::class, 'displayHome']);
Route::post('/newgame', [UserController::class, 'displaySearch']);


/********************************
 * Game loop
 ********************************/
Route::get('/games', [GameController::class, 'displayGames']); //Route de tests
Route::resource('question', QuestionController::class);

/********************************
 * Login & Registration
 ********************************/
//Register
Route::get("/register", [RegisterController::class, "showRegisterView"]);
Route::post("/register", [RegisterController::class, "register"]);


//Email confirmation
Route::get("/verify", [RegisterController::class, "showVerifyEmailView"])
->middleware('auth')->name('verification.notice');

Route::get('/verify/{id}/{hash}', [RegisterController::class, "handleVerificationEmail"])
->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [RegisterController::class, 'resendVerificationEmail'])
->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/protege', function() { //Route de test
    return 'lol';
})->middleware('verified');;

//Login
Route::get("/login", [LoginController::class, "showLoginView"])->name('login');
Route::post("/login", [LoginController::class, "authenticate"]);

//Logout
Route::get("/logout", [LoginController::class, "logout"]);

/********************************
 * Routes accessible only by admin users 
 ********************************/

Route::group(['middleware' => ['admin']], function () {
    Route::get('backoffice', function () {
        return view('backoffice/home_backoffice');
    });
    Route::resource('backoffice/question', QuestionController::class);
    Route::resource('backoffice/user', UserController::class);
});

