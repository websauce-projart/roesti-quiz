<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(Auth::check()) {
            return redirect()->route('verification.notice');
        }
    //     if (!is_null(Auth::user())) {   //le user est authentifié



    //         $user_id = Auth::user()->id;
    //         $user = User::where('id', $user_id)->first();

    //         if(!is_null($user->email_verified_at)) {    //le user est verifié
    //             return redirect()->route('home');
    //         } else {    //le user n'est pas verifié
    //             return redirect()->route('verification.notice');
    //         }



    //    } else { //le user n'est pas authentifié
    //     return redirect()->route('login');
    //    }
       
    // }
}
