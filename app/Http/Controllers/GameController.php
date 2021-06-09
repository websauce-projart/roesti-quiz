<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

class GameController extends Controller
{
    /**
     * Display the home page when a user is logged in with his datas, the opponents and his current games.
     *
     * @return void
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }

	/**
	 * Get the two users from a game
	 * @param $game_id ID of the game
	 * @return Array the two users
	 */
	public static function getPlayers($game_id)
	{
		$gameUsers_data = DB::table("game_user")->where("game_id", $game_id)->get();
		$users = [];
		foreach ($gameUsers_data as $data) {
			$user_id = $data->user_id;
			$user = User::find($user_id);
			array_push($users, $user);
		}
		return $users;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return view Categories
	 */
	public function createGame(Request $request)
	{
		//Retrieve data
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$opponent = User::where('id', $request->user)->first();
		
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

	//Returning vie Home with the datas
	public function displayHome()
	{
		return view('home/home');
	}

	//Returning vie Home with the datas
	public function requestHomeData()
	{
		$user_id = Auth::user()->id;
		$user = User::where('id', $user_id)->first();
		$games = $user->games()->get();
		$data = array();
		
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
		
		
		return response()->json($data);;
	}


	// Cette fonction est-elle utilisée quelque part?????
	// public function displayGame(Request $request)
	// {
	// 	$game_id = $request->game_id;
	// 	return ResultController::showResultsView($game_id);
	// }
}
