<?php

<<<<<<< HEAD
use App\Http\Controllers\UserController;
=======
use App\Http\Controllers\LoginController;
>>>>>>> 9196b9b8222f26c3121ca6eb4341bfee16cda2e3
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GameController;

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

<<<<<<< HEAD
Route::get('/games', [GameController::class, 'displayGames']);
=======
Route::get("/login", [LoginController::class, "showLoginView"]);
Route::post("/login", [LoginController::class, "authenticate"]);
Route::get("/logout", [LoginController::class, "logout"]);
>>>>>>> 9196b9b8222f26c3121ca6eb4341bfee16cda2e3
