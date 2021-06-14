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
        if (!is_null(Auth::user())) {   //the user is authentified
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();

            if(!is_null($user->email_verified_at)) {    //the user is verified
                return redirect()->route('home');

            } else {    //the user is not verified
                return $next($request);
            }

       } else {  //the user is not authentified
        return $next($request);
       }

    }
}
