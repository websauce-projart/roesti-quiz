<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\BackofficeController;
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

Route::group(['middleware' => ['verified', 'notadmin']], function () {

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

	Route::get('/user/{user_id}', [UserController::class, 'displayProfile'])->name('profile');
	Route::post('/user/{user_id}', [UserController::class, 'deleteAccount']);

	Route::get('/user/{user_id}/update-password', [AuthController::class, 'showUpdatePassword'])->name('updatePasswordForm');
	Route::post('/user/{user_id}/update-password', [AuthController::class, 'updatePassword']);

	Route::get('/user/{user_id}/update-avatar', [AvatarController::class, 'displayAvatarEditor'])->name('updateAvatar');
	Route::post('/user/{user_id}/update-avatar', [AvatarController::class, 'updateAvatar']);


	/********************************
	 * Gameloop
	 ********************************/

	Route::post('/home', [UserController::class, 'displaySearch']);

	Route::post('/game', [GameController::class, 'createGame'])->name('creategame');

	Route::get('/game/{game_id}/category', [CategoryController::class, 'displayCategoryView'])->name('category');
	Route::post('/game/{game_id}/category', [RoundController::class, 'createRound']);

	Route::get('/game/{game_id}/', [ResultController::class, 'showResultsView'])->name('results');

	Route::get("/game/{game_id}/round/{round_id}", [QuizController::class, 'showQuizView'])->name('quiz');

	Route::get("/game/{game_id}/round/{round_id}/history", [RoundController::class, "showHistoryView"])->name("round_history");

	Route::post("/game/{game_id}/round/{round_id}/result/{result_id}", [QuizController::class, 'createAnswers'])->name('postquiz');

	Route::get('/game/{game_id}/round/{round_id}/result/{result_id}', [QuizController::class, 'showEndgameView'])->name('endgame');

	Route::get('/game/{game_id}/join', [ResultController::class, 'redirectFromHome'])->name('join');
	Route::get('/game/{game_id}/play', [QuizController::class, 'redirectFromResults'])->name('play');


	/********************************
	 * Onboarding
	 ********************************/

	Route::group(['middleware' => ['onboarded']], function () {

		Route::get('/welcome', [OnboardingController::class, 'displayWelcome'])->name('onboardingWelcome');
		Route::get('/welcome/avatar', [AvatarController::class, 'displayAvatarCreator'])->name('onboardingAvatar');
		Route::post('/welcome/avatar', [AvatarController::class, 'createAvatar']);
		Route::get('/welcome/quiz', [OnboardingController::class, 'displayQuizTutorial'])->name('onboardingQuiz');
		Route::get('/welcome/history', [OnboardingController::class, 'displayHistoryTutorial'])->name('onboardingHistory');
		Route::get('/welcome/friends', [OnboardingController::class, 'displayFriendsTutorial'])->name('onboardingFriends');
		Route::get('/welcome/exit', [OnboardingController::class, 'quitOnboarding'])->name('onboardingExit');

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

	Route::post('/reset-password/{token}', [AuthController::class, 'handleResetForm']);
});

//Logout
Route::get("/logout", [AuthController::class, "logout"])->name('logout');


/********************************
 * Admin backoffice
 ********************************/

Route::group(['middleware' => ['admin']], function () {

	Route::get('/backoffice', [BackofficeController::class, 'showBackofficeView'])->name('backoffice');
	Route::resource('/backoffice/users', UserController::class)->except(['show', 'create', 'store']);
	Route::resource('/backoffice/admins', AdminController::class)->except(['show']);
	Route::resource('/backoffice/questions', QuestionController::class)->except(['show']);
	
});
