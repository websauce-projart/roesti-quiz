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
        $admins = User::where('admin', 1)->get();
        return view('backoffice/list_admin')->with('users', $admins);
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return view backoffice/add_admin
     */
    public function create()
    {
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
        $user = User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        $user->admin = 1;
        $user->has_onboarded = 1;
        $user->email_verified_at = now();
        $user->save();

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
        $user = User::FindOrFail($id);
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
        User::findOrFail($id)->update($request->all());
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
        $user = User::findOrFail($id);
        $pseudo = $user->pseudo;

        User::findOrFail($id)->delete();
        return redirect()->route('admins.index')->withOk("L'administrateur " . $pseudo . " a été supprimé.");
    }
}
