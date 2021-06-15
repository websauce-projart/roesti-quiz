<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OnboardingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


//Verified and not admin users
Route::group(['middleware' => ['verified', 'notadmin']], function () {


	/********************************
	 * Home
	 ********************************/

	//Return the home view
	Route::get('/', [HomeController::class, 'redirectToHome']);
	Route::get('/home', [HomeController::class, 'showHomeView'])->name('home');

	//Return the search view
	Route::post('/home', [HomeController::class, 'showSearchView']);

	//Redirect from home page according to the state of the game
	Route::get('/game/{game_id}/join', [HomeController::class, 'redirectFromHome'])->name('join');


	/********************************
	 * Gameloop
	 ********************************/

	//Create game from search page
	Route::post('/game', [GameController::class, 'createGame'])->name('creategame');

	//Return view to choose a category after the game is created
	Route::get('/game/{game_id}/category', [GameController::class, 'showCategoryView'])->name('category');

	//Create round with choosen category
	Route::post('/game/{game_id}/category', [GameController::class, 'createRound']);

	//Return view with game's results for each rounds
	Route::get('/game/{game_id}/', [GameController::class, 'showResultsView'])->name('results');

	//Redirect from game's results page according to the state of the game
	Route::get('/game/{game_id}/play', [GameController::class, 'redirectFromResults'])->name('play');

	//Return round history view from results page
	Route::get("/game/{game_id}/round/{round_id}/history", [GameController::class, "showHistoryView"])->name("round_history");

	//Return quiz from results page
	Route::get("/game/{game_id}/round/{round_id}", [QuizController::class, 'showQuizView'])->name('quiz');

	//Create user's answers on quiz end
	Route::post("/game/{game_id}/round/{round_id}/result/{result_id}", [QuizController::class, 'createAnswers'])->name('postquiz');

	//Return round's result view on answers creation
	Route::get('/game/{game_id}/round/{round_id}/result/{result_id}', [QuizController::class, 'showEndgameView'])->name('endgame');


	/********************************
	 * Profile
	 ********************************/

	//Return user profile
	Route::get('/user/{user_id}', [UserController::class, 'displayProfile'])->name('profile');

	//Delete user
	Route::post('/user/{user_id}', [UserController::class, 'deleteAccount']);

	//Update user's password
	Route::get('/user/{user_id}/update-password', [AuthController::class, 'showUpdatePasswordView'])->name('updatePasswordForm');
	Route::post('/user/{user_id}/update-password', [AuthController::class, 'updatePassword']);

	//Update user's avatar
	Route::get('/user/{user_id}/update-avatar', [AvatarController::class, 'showAvatarEditorView'])->name('updateAvatar');
	Route::post('/user/{user_id}/update-avatar', [AvatarController::class, 'updateAvatar']);


	/********************************
	 * Onboarding
	 ********************************/

	//Users which have not yet onboarded 
	Route::group(['middleware' => ['onboarded']], function () {

		//Return a view for each onboarding step
		Route::get('/welcome', [OnboardingController::class, 'showWelcomeView'])->name('onboardingWelcome');
		Route::get('/welcome/avatar', [AvatarController::class, 'showAvatarCreatorView'])->name('onboardingAvatar');
		Route::post('/welcome/avatar', [AvatarController::class, 'createAvatar']);
		Route::get('/welcome/quiz', [OnboardingController::class, 'showQuizTutorialView'])->name('onboardingQuiz');
		Route::get('/welcome/history', [OnboardingController::class, 'showHistoryTutorialView'])->name('onboardingHistory');
		Route::get('/welcome/friends', [OnboardingController::class, 'showFriendsTutorialView'])->name('onboardingFriends');
		Route::get('/welcome/exit', [OnboardingController::class, 'quitOnboarding'])->name('onboardingExit');

	});


	/********************************
	 * Api homemade
	 ********************************/

	//Return data to be used in Vue.js components
	Route::get('/api/home', [HomeController::class, 'requestHomeData']);
	Route::get('/api/avatar/{user_id}', [AvatarController::class, 'requestAvatarData']);

});


/********************************
 * Authentification
 ********************************/

//Logout
Route::get("/logout", [AuthController::class, "logout"])->name('logout');

//Users which are not authentified
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


/********************************
 * Admin backoffice
 ********************************/

//Users which are admins
Route::group(['middleware' => ['admin']], function () {

	//Return a view for each backoffice section
	Route::get('/backoffice', function () {
		return view('backoffice/home_backoffice');
	})->name('backoffice');
	Route::resource('/backoffice/users', UserController::class)->except(['show', 'create', 'store']);
	Route::resource('/backoffice/admins', AdminController::class)->except(['show']);
	Route::resource('/backoffice/questions', QuestionController::class)->except(['show']);

});
