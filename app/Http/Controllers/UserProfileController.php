<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show() {
        return view('users.profiles.show');
    }

    public function create() {
        return view('users.profiles.create');
    }

    public function edit() {
        return view('users.profiles.edit');
    }
}
