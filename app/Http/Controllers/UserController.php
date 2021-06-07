<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $users = User::all();
        return view('backoffice/user_list')->with('users',$users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::FindOrFail($id);
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
        $this->setAdmin($request);
        User::findOrFail($id)->update($request->all());
        return redirect('backoffice/user')->withOk("L'utilisateur " . $request->input('pseudo') . " a été modifié");
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

        foreach($games as $game) {
            Game::findOrFail($game->id)->delete();
        }
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

    private function setAdmin($request) {
        if (!$request->has('admin')) {
           $request->merge(['admin'=>0]);
        }
    }
    
    /**
     * Display the view to look for a new player to play against. Only a user that the demanding user is not yet playing against appears.
     *
     * @return void
     */
    public function displaySearch()
    {
        $currentUser = Auth::user();
        $users = User::all();
        $games = $currentUser->games;
        $tabGamesStarted = [];
        $listUser = [];
        $data = [];

        foreach($games as $game) {
            $opponent = $currentUser->getOtherUser($game->id);
            array_push($tabGamesStarted, $opponent->id);
        }

        foreach($users as $user) {
            array_push($listUser, $user->id);
        }

        array_push($tabGamesStarted, $currentUser->id);

        $listUser = array_diff($listUser, $tabGamesStarted);

        
        foreach($listUser as $userId) {
            array_push($data, User::findorfail($userId));
        }

        return view('home/new_game')->with('data', $data);
    }
    
    /**
     * Display view profile for a user with his total score, his ranking, the avatar.
     *
     * @return void
     */
    public function displayProfile()
    {
        $ranking = [
            '0' => 'egal 0',
            '1000' => 'moins de milles',
            '5000' => 'moins de 5 milles',
        ];
    
        $currentUser = Auth::user();

        $scores = Result::all()->where('user_id', $currentUser->id);
        $scoreTotal = 0;
        foreach($scores as $score){
            $scoreTotal = $scoreTotal + $score->score;
        };

        foreach($ranking as $condition => $label){

            if($scoreTotal == 0){
                $labelTitle = $label;
                break;
            }else if($scoreTotal < $condition){
                $labelTitle = $label;
                break;
            }
        }

        $score = array(
            "points" => $scoreTotal,
            "titleScore" => $labelTitle.'Change in UserController function displayProfile to adapt the labels of each ranking',
        );

        $data = array(
            "user" => $currentUser,
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
        session()->flash('account-deleted','Votre compte a bien été supprimé !');
        return redirect()->route('login');
    }
}
