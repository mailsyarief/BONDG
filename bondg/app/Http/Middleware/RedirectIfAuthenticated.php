<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && ($request->user()->role == 1)) {
            return redirect('/dashboard');
        }
        else if (Auth::guard($guard)->check() && ($request->user()->role == 2)) {
            return redirect('/laporan');
        }
        else if (Auth::guard($guard)->check() && ($request->user()->role == 0)) {
            return redirect('/home');
        }
        return $next($request);
    }
}
