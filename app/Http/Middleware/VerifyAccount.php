<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAccount
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
            $email_verified_at = Auth::user()->email_verified_at; // get user id
            
            if($email_verified_at == NULL) { // if email is not verified){
                return $next($request);
            } else {
                return redirect('/verificacion');
            }
        }
        return $next($request);
    }
}
