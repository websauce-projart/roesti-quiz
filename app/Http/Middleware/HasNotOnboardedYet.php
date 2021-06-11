<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HasNotOnboardedYet
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
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();

        if($user->has_onboarded) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
