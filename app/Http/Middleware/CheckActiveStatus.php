<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckActiveStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::check() && Auth::user()->active == 0){

            Auth::logout();

            $request->session()->flash('alert-danger', 'Akun anda tidak aktif. Silahkan hubungi admin.');

            return redirect('/login')->with('danger', 'Akun anda tidak aktif. Silahkan hubungi admin.');

        }
        return $next($request);
    }
}
