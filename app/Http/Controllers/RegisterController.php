<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;    

class RegisterController extends Controller
{
    //Inspiré de :
    //https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/

    /**
	 * Return register view with form
	 * @return view
	 **/
	public function showRegisterView()
	{
		return view("register");
	}
        
    /**
     * Register a user
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {  
        $request->validate([
            'pseudo' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("/")->withSuccess('😊 Votre compte a été crée! 😊');
    }
    
    /**
     * Create a user in the BDD
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data)
    {
      return User::create([
        'pseudo' => $data['pseudo'],
        'email' => $data['email'],
        'password' => $data['password']
      ]);
    } 
}