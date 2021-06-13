<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return view backoffice/list_user
     */
    public function index()
    {
        //Retrieve data
        $users = User::where('admin', 0)->get();

        //Return view
        return view('backoffice/list_user')->with('users', $users);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $user_id
     * @return view backoffice/edit_user
     */
    public function edit($user_id)
    {
        //Retrieve data
        $user = User::FindOrFail($user_id);

        //Return view
        return view('backoffice/edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  int  $id
     * @return redirect to users.index route
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //Retrieve data
        User::findOrFail($id)->update($request->all());

        //Return redirect
        return redirect()->route('users.index')->withOk("L'utilisateur " . $request->input('pseudo') . " a été modifié.");
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     * @return redirect to users.index route
     */
    public function destroy($id)
    {
        //Retrieve data
        $user = User::findOrFail($id);
        $games = $user->games;
        $pseudo = $user->pseudo;

        //Delete each game the user was part of
        foreach($games as $game) {
            Game::findOrFail($game->id)->delete();
        }

        //Delete the user
        User::findOrFail($id)->delete();

        //Return redirect
        return redirect()->route('users.index')->withOk("L'utilisateur " . $pseudo . " a été supprimé.");
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
     * Return the profile view of a specified user
     *
     * @param  int $user_id
     * @return view profile/profile
     */
    public function displayProfile($user_id)
    {
        //Retrieve data
        $user = User::where('id', Auth::user()->id)->first();
        $totalScore = $user->getTotalScore();
        $title = $user->getTitle();

        //Checks if the profile displayed belongs to the authentified one
        if($user_id != $user->id) {
            return redirect()->route('profile', [$user->id]);
        }

        //Rearrange data
        $score = array(
            "points" => $totalScore,
            "titleScore" => $title,
        );

        $data = array(
            "user" => $user,
            "score" => $score,
        );

        //Return view
        return view('profile/profile')->with('data', $data);
    }
    
    /**
     * Delete the user with everything connected to it in the database, redirect him on the login page, made to be used by the user.
     *
     * @return redirect to login route
     */
    public function deleteAccount()
    {
        //Retrieve data
        $user = Auth::user();
        $games = $user->games;

        //Delete each game the user was part of
        foreach($games as $game) {
            Game::findOrFail($game->id)->delete();
        }
        
        //Delete the user
        User::findOrFail($user->id)->delete();

        //Return view
        session()->flash('account-deleted','Le compte a bien été supprimé !');
        return redirect()->route('login');
    }
}
