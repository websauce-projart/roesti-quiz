<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Game;
use App\Models\Result;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('admin', 0)->get();
        return view('backoffice/list_user')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::FindOrFail($user_id);
        return view('backoffice/edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect()->route('users.index')->withOk("L'utilisateur " . $request->input('pseudo') . " a été modifié.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $games = $user->games;
        $pseudo = $user->pseudo;

        foreach($games as $game) {
            Game::findOrFail($game->id)->delete();
        }
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->withOk("L'utilisateur " . $pseudo . " a été supprimé.");
    }
    
    /**
     * Display the view to look for a new player to play against. Only a user that the demanding user is not yet playing against appears.
     *
     * @return void
     */
    public function displaySearch()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $potentialOpponents = $user->getAllPotentialOpponents()->all();

        return view('home/search')->with('opponents', $potentialOpponents);
    }
    
    /**
     * Display view profile for a user with his total score, his ranking, the avatar.
     *
     * @return void
     */
    public function displayProfile($user_id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if($user_id != $user->id) {
            return redirect()->route('profile', [$user->id]);
        }

        $ranking = [
            '0' => 'Bobet de service',
            '10000' => 'Topio de première',
            '20000' => 'Taguenasset',
            '30000' => 'Frontalier·ère',
            '40000' => 'Apprenti·e romand·e',
            '50000' => 'Thé froid de la Migros',
            '60000' => 'Rösti confirmé',
            '70000' => 'Expert·e romand·e',
            '80000' => 'Champion·ne de Romandie',
            '90000' => 'Roi·Reine des Röstis ',
        ];

        $totalScore = $user->getTotalScore();

        foreach($ranking as $condition => $label){

            if($totalScore == 0){
                $labelTitle = $label;
                break;
            }else if($totalScore < $condition){
                $labelTitle = $label;
                break;
            }
        }

        $score = array(
            "points" => $totalScore,
            "titleScore" => $labelTitle,
        );

        $data = array(
            "user" => $user,
            "score" => $score,
        );
        return view('profile/profile')->with('data', $data);
    }
    
    /**
     * Delete the user with everything connected to it in the database, redirect him on the login page.
     *
     * @return void
     */
    public function deleteAccount()
    {
        $user = Auth::user();
        $games = $user->games;

        foreach($games as $game) {
            Game::findOrFail($game->id)->delete();
        }
        
        User::findOrFail($user->id)->delete();
        session()->flash('account-deleted','Le compte a bien été supprimé !');
        return redirect()->route('login');
    }
}
