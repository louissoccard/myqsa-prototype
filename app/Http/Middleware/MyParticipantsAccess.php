<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class MyParticipantsAccess
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
        if (app('auth')->guard(null)->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (Auth::user()->hasDistrictAccess()) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions(['qsa.district.view']);
    }
}
