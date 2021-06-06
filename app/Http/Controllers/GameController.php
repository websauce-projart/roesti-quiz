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
		$activeUserId = Auth::user()->id;
		$opponentId = $request->user;
		$game = Game::create(['active_user_id' => $activeUserId]);
		$game->users()->attach($activeUserId);
		$game->users()->attach($opponentId);

		session(["game" => $game]);


		return redirect()->route('category');
		// return CategoryController::displayCategoryView();
		
	}

	//Returning vie Home with the datas
	public function displayHome()
	{
		//Clean session
        $dataToClean = [
            'game',
            'round',
            'result',
            'questions'
        ];

        foreach ($dataToClean as $data) {
            if(session()->has($data)) {
                session()->forget($data);
            }
        }

		$activeUserId = Auth::user()->id;

		$user = User::where('id', $activeUserId)->first();
		$games = $user->games;

		$data = [];
		foreach ($games as $game) {
			$gameId = $game->id;

			$opponent = $user->getOtherUser($gameId);
			$gameData = array(
				"user" => $user,
				"opponent" => $opponent,
				"game" => $game
			);

			array_push($data, $gameData);
		}
		return view('home/home')->with('data', $data);
	}

	/**
	 * Test
	 */
	public function displayGames()
	{
		$activeUserId = 1;

		$user = User::where('id', $activeUserId)->first();

		$games = $user->games;

    }
    /*public function displayHome() {
        $activeUserId = Auth::user()->id;
            
        $user = User::where('id', $activeUserId)->first();
        $games = $user->games;

		$data = [];
		foreach ($games as $game) {
			$gameId = $game->id;

			$opponent = $user->getOtherUser($gameId);

			$gameData = array(
				"user" => $user,
				"opponent" => $opponent,
				"game" => $game
			);

			array_push($data, $gameData);
		}
		return view('gameloop/games')->with('data', $data);
	}*/
}
