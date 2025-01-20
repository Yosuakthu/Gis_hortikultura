<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $level
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        if (Auth::check() && Auth::user()->level_id == $level) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this section.');
    }
}
