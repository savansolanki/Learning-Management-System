<?php

namespace LMS\Http\Middleware;

use LMS\User;
use Auth;
use Closure;

class Tutor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == User::TUTOR) {
            return $next($request);
        } else {
            return redirect(route('logout'))->with(['error' => 'Unauthorised Access']);
        }
    }
}
