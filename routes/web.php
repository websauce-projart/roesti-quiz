<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OnboardingController;

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
 * Verified user
 ********************************/
Route::group(['middleware' => ['verified']], function () {

	/********************************
	 * Api homemade
	 ********************************/
	Route::get('/api/home', [GameController::class, 'requestHomeData']);
	Route::get('/api/avatar/{user_id}', [AvatarController::class, 'dataAvatar']);

	/********************************
	 * Home
	 ********************************/
	Route::get('/home', [GameController::class, 'displayHome'])->name('home');
	Route::get('/', function () {
		return redirect()->route('home');
	});


	/********************************
	 * Profile
	 ********************************/
	Route::get('/profile', [UserController::class, 'displayProfile'])->name('profile');
	Route::post('/profile', [UserController::class, 'deleteAccount'])->name('deleteAccount');
	Route::get('/update-password', [AuthController::class, 'showUpdatePassword'])->name('updatePasswordForm');
	Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('updatePassword');
	Route::get('/update-avatar', [AvatarController::class, 'displayAvatarEditor'])->name('updateAvatar');
	Route::post('/update-avatar', [AvatarController::class, 'updateAvatar']);


	/********************************
	 * Gameloop
	 ********************************/

	Route::post('/home', [UserController::class, 'displaySearch']); //Checké

	Route::post('/game', [GameController::class, 'createGame'])->name('creategame'); //Checké

	Route::get('/game/{game_id}/category', [CategoryController::class, 'displayCategoryView'])->name('category'); //Checké - contrôle à tester
	Route::post('/game/{game_id}/category', [RoundController::class, 'createRound']); //Terminé

	Route::get('/game/{game_id}/', [ResultController::class, 'showResultsView'])->name('results'); //Terminé

	Route::get("/game/{game_id}/round/{round_id}", [QuizController::class, 'showQuizView'])->name('quiz'); //Terminé

	Route::post("/game/{game_id}/round/{round_id}/result/{result_id}", [QuizController::class, 'createAnswers'])->name('postquiz'); //Terminé

	Route::get('/game/{game_id}/round/{round_id}/result/{result_id}', [QuizController::class, 'showEndgameView'])->name('endgame'); //Terminé

	Route::get('/game/{game_id}/join', [ResultController::class, 'redirectFromHome'])->name('join'); //Terminé
	Route::get('/game/{game_id}/play', [QuizController::class, 'redirectFromResults'])->name('play'); //Terminé

	Route::get("/game/{game_id}/round/{round_id}/history", [RoundController::class, "showHistoryView"])->name("round_history");

	/********************************
	 * Onboarding
	 ********************************/
	Route::group(['middleware' => ['onboarded']], function () {	//
		Route::get('/welcome/1', [OnboardingController::class, 'displayWelcome'])->name('onboardingWelcome');
		Route::get('/welcome/2', [AvatarController::class, 'displayAvatarCreator'])->name('onboardingWelcome');
		Route::post('/welcome/2', [AvatarController::class, 'createAvatar']);
		Route::get('/welcome/3', [OnboardingController::class, 'displayQuizTutorial'])->name('onboardingQuiz');
		Route::get('/welcome/4', [OnboardingController::class, 'displayHistoryTutorial'])->name('onboardingHistory');
		Route::get('/welcome/5', [OnboardingController::class, 'displayFriendsTutorial'])->name('onboardingFriends');
	});
});



/********************************
 * Login & Registration
 ********************************/
Route::group(['middleware' => ['guest']], function () {

	//Register
	Route::get("/register", [AuthController::class, "showRegisterView"])->name('register');
	Route::post("/register", [AuthController::class, "register"]);

	//Login
	Route::get("/login", [AuthController::class, "showLoginView"])->name('login');
	Route::post("/login", [AuthController::class, "authenticate"]);

	//Email confirmation
	Route::get("/verify", [AuthController::class, "showVerifyEmailView"])
		->middleware(['auth'])->name('verification.notice');

	Route::get('/login/{id}/{hash}', [AuthController::class, "handleVerificationEmail"])
		->middleware(['auth', 'signed'])->name('verification.verify');

	Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])
		->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

	//Password reset
	Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordView'])
		->name('password.request');

	Route::post('/forgot-password', [AuthController::class, 'sendPasswordEmail'])
		->name('password.email');

	Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
		->name('password.reset');

	Route::post('/reset-password', [AuthController::class, 'handleResetForm']);
});

//Logout
Route::get("/logout", [AuthController::class, "logout"])->name('logout');


/********************************
 * Admin backoffice
 ********************************/
Route::group(['middleware' => ['admin']], function () {
	Route::get('/backoffice', function () {
		return view('backoffice/home_backoffice');
	});
	Route::resource('/backoffice/question', QuestionController::class);
	Route::resource('/backoffice/user', UserController::class);
});
