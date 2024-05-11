<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class IsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $per)
    {
        if (Auth::check() && Auth::user()->hasPermission($per)) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Unauthorized Access');
    }
}
