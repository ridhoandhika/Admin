<?php

namespace App\Http\Middleware;

use Closure;

class SessionLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if(!session('berhasil_login')){ // in_array($request->user()->role, $roles)){
            return redirect('/');
        }
        return $next($request);
    }
}
