<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) { // first check if there is a logged in user
            $last_seen = Auth::user()->last_seen; // get user id
            
            $date = Carbon::parse($last_seen);
            $now = Carbon::now();

            $diff = $date->diffInDays($now);

            if ($diff > 1) {
                Auth::logout();
                return redirect('/sesiones');
            }
        }
        return $next($request);
    }
}
