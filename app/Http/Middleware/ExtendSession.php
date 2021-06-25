<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExtendSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // User is a Leader then set re-sign in length to 7 days (7x24x60)
        if ($request->user() !== null && $request->user()->hasRole('leader')) {
            config(['session.lifetime' => 10080]);
        } elseif ($request->user() !== null && $request->user()->hasRole('admin')) {
            // If the user is an admin, set re-sign in length to 1 day (24x60)
            config(['session.lifetime' => 1440]);
        }

        return $next($request);
    }
}
