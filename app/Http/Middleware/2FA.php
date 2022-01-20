<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Google2FAMiddleware
class FA
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
        
        $authentication = app(Google2FAAuthentication::class)->boot($request);

        
        if ($authentication->isAuthenticated()) {
            return $next($request);
        }

        return $authentication->makeRequestOneTimePasswordResponse();
    }
}
