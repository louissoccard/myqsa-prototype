<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AwardController extends Controller
{
    public function show()
    {
        if (Session::exists('award_user')) {
            $user = User::find(Session::get('award_user'));
        } else {
            $user = Auth::user();
        }

        return view('award', ['user' => $user]);
    }

    public function clear()
    {
        Session::forget('award_user');

        return redirect()->route(Session::pull('award_redirect_route', 'dashboard'));
    }
}
