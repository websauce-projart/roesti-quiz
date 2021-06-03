<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
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
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

    private function setAdmin($request) {
        if (!$request->has('admin')) {
           $request->merge(['admin'=>0]);
        }
    }

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
}
