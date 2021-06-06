<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Store a newly created game in the database. Attach the new game to both players in game_user table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activeUserId = Auth::user()->id;
        $opponentId = $request->user;
        $game = Game::create(['active_user_id' => $activeUserId]);
        $game->users()->attach($activeUserId);
        $game->users()->attach($opponentId);
        return view('THOMAS')->with('data', $game->id);
    }
    
    /**
     * Display the home page when a user is logged in with his datas, the opponents and his current games.
     *
     * @return void
     */
    public function displayHome() {
        $activeUserId = Auth::user()->id;
            
        $user = User::where('id', $activeUserId)->first();
        $games = $user->games;

        $data = [];
        foreach($games as $game) {
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

}
