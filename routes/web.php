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

Route::get('/', function () {
	return view('welcome');
});

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

//Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//Login
Route::get("/login", [LoginController::class, "showLoginView"]);
Route::post("/login", [LoginController::class, "authenticate"]);

//Logout
Route::get("/logout", [LoginController::class, "logout"]);

/********************************
 * Routes accessible only by admin users 
 ********************************/

Route::group(['middleware' => ['admin']], function () {
    Route::resource('question', QuestionController::class);
});

