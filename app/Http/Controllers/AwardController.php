<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller {
    public function show() {
        return view('award', ['user' => Auth::user()]);
    }
}
