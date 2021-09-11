<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AwardAccessMiddleware
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

        if (Session::exists('award_user')) {
            $district_id = User::find(Session('award_user'))->district_id;
            if (Auth::user()->hasPermissionTo("qsa.district.view.*") || Auth::user()->hasPermissionTo("qsa.district.view.{$district_id}")) {
                return $next($request);
            }
        } elseif (Auth::user()->hasPermissionTo('qsa.has')) {
            return $next($request);
        }

        throw UnauthorizedException::forPermissions(['qsa.has']);

    }
}
