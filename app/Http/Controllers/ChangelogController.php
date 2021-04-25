<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class ChangelogController extends Controller
{
    public function show() {
        $markdown = File::get(base_path() . '/CHANGELOG.md');
        $markdown = str_replace('#Changelog', '', $markdown);

        return view('admin-centre.changelog.show', ['markdown' => $markdown]);
    }
}
