<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewGameRequest;

class GameController extends Controller
{
	// À SUPPRIMER SI UTILISÉE NULLE PART !!!!
	// /**
	//  * Get the two users from a game
	//  * @param $game_id ID of the game
	//  * @return Array the two users
	//  */
	// public static function getPlayers($game_id)
	// {
	// 	$gameUsers_data = DB::table("game_user")->where("game_id", $game_id)->get();
	// 	$users = [];
	// 	foreach ($gameUsers_data as $data) {
	// 		$user_id = $data->user_id;
	// 		$user = User::find($user_id);
	// 		array_push($users, $user);
	// 	}
	// 	return $users;
	// }

	/**
	 * Store a newly created game in storage.
	 *
	 * @param Request $request
	 * @return redirect to categories or results route
	 */
	public function createGame(NewGameRequest $request)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$opponent = User::where('pseudo', $request->user)->first();
		
		//Checks if game exists already
		if(Game::isExistingAlready($user, $opponent)) {
			$game = Game::getGameFromUsers($user, $opponent);
			$round_count = $game->rounds()->get()->count();

			//If user created a game but left before choosing a category
			if($round_count == 0) {
				return redirect()->route('category', [$game]);
			}

			//If at least a round exists already
			if($round_count > 0) {
				return redirect()->route('results', [$game]);
			}
		};
		
		//Create game
		$game = Game::create(['active_user_id' => $user->id]);
		$game->users()->attach($user->id);
		$game->users()->attach($opponent->id);

		//Redirect to categories
		return redirect()->route('category', [$game]);		
	}

	/**
	 * Return home view with user data
	 *
	 * @return view home/home
	 */
	public function displayHome()
	{
		//Checks if user has onboarded yet
		$user_id = Auth::user()->id;
		if(!User::where('id', $user_id)->first()->has_onboarded) {
			
			return redirect()->route('onboardingWelcome');
		}

		//Return view
		return view('home/home')
		->with('user_id', $user_id);
	}
	
	/**
	 * Return games data needed for home view
	 *
	 * @return array games data in json
	 */
	public function requestHomeData()
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$games = $user->games()->get();
		$data = array();
		
		//Process data
		foreach ($games as $game) {
			
			$game_id = $game->id;
			$opponent = $user->getOtherUser($game_id);
			
			$gameData = array(
				"user" => $user,
				"opponent" => $opponent,
				"game" => $game
			);
			array_push($data, $gameData);
		}
		
		//Return data
		return response()->json($data);;
	}
}
