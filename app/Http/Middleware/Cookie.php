<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cookie
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
        $role_id = Auth::user()->role_id;
        $ip = $request->ip();
        if ($role_id == 1 && $ip == '127.0.0.1') {
            $time = time() + 60 * 60 * 24;
            $res = $next($request);
            return $res->cookie('origin_sesion', true, $time, "/");
        } 
        

        return $next($request);
    }
}
