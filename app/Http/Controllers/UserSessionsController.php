<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSessionsController extends Controller
{
    public function create() {
        return view('users.sessions.create');
    }
}
