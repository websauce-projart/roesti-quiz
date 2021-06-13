<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of all admins.
     *
     * @return view backoffice/list_admin
     */
    public function index()
    {
        //Retrieve data
        $admins = User::where('admin', 1)->get();

        //Return view
        return view('backoffice/list_admin')->with('users', $admins);
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return view backoffice/add_admin
     */
    public function create()
    {
        //Return view
        return view('backoffice/add_admin');
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param  UserCreateRequest  $request
     * @return redirect to admins.index route
     */
    public function store(UserCreateRequest $request)
    {
        //Create the admin
        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        //Set user as admin and non player
        $user->admin = 1;
        $user->has_onboarded = 1;
        $user->email_verified_at = now();
        $user->save();

        //Return view
        return redirect()->route('admins.index')->withOk("L'administrateur " . $user->pseudo . " a été créé.");
    }

    /**
     * Show the form for editing an admin.
     *
     * @param  int  $id
     * @return view backoffice/edit_admin
     */
    public function edit($id)
    {
        //Retrieve data
        $user = User::FindOrFail($id);

        //Return view
        return view('backoffice/edit_admin', compact('user'));
    }

    /**
     * Update the admin in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  int  $id
     * @return redirect to admins.index route
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //Retrieve data
        User::findOrFail($id)->update($request->all());

        //Return view
        return redirect()->route('admins.index')->withOk("L'administrateur " . $request->input('pseudo') . " a été modifié.");
    }

    /**
     * Remove the admin from storage.
     *
     * @param  int  $id
     * @return redirect to admins.index route
     */
    public function destroy($id)
    {
        //Retrieve data
        $user = User::findOrFail($id);
        $pseudo = $user->pseudo;

        //Delete admin
        User::findOrFail($id)->delete();

        //Return view
        return redirect()->route('admins.index')->withOk("L'administrateur " . $pseudo . " a été supprimé.");
    }
}
