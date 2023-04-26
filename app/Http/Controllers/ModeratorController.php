<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function index() {
        return redirect('/moderator/questions');
        return view('moderators.index');
    }
}
