<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Round;
use App\Models\Result;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Redirect to home route
     *
     * @return void
     */
    public function redirectToHome() {
        return redirect()->route('home');
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
     * Return the view to look for a new player to play against
     *
     * @return view home/search
     */
    public function displaySearch()
    {
        //Retrieve data
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $potentialOpponents = $user->getAllPotentialOpponents()->all();

        //Return view
        return view('home/search')->with('opponents', $potentialOpponents);
    }

    /**
	 * Redirect the user from the home page to where he needs to go according to the game state
	 *
	 * @param  Request $request
	 * @return redirect to home, category or results route
	 */
	public function redirectFromHome(Request $request)
	{
		$user = User::where('id', Auth::user()->id)->first();
		$game = Game::where('id', $request->game_id)->first();
		$players = $game->users()->get();

		//If the player doesn't belong to the game -> redirected to home
		if (!$players->contains($user)) {
			return redirect()->route('home');
		}

		//If the game has no rounds created -> redirected to home
		$round = Round::where('game_id', $game->id)->orderBy('created_at', 'DESC')->first();
		if(is_null($round)) {
			return redirect()->route('category', [$game]);
		}

		//If the player isn't the active player -> redirected to home
		if ($game->active_user_id !== $user->id) {
			return redirect()->route('results', [$game]);
		}

		//If the user is the active player:
		$results = Result::where('round_id', $round->id)->get();
		if (count($results) >= 2) {
			//The game has more than 2 results, so the user is the one choosing the category
			return redirect()->route('category', [$game]);

		} else {
			//The category has already been chosen, the user go the results and play
			return redirect()->route('results', [$game]);
		}
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
