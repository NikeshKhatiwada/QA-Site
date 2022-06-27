<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorSessionsController extends Controller
{
    public function create() {
        return view('moderators.sessions.create');
    }

    public function store() {
        $attributes = request()->validate([
            'username' => ['required'],
            'password'=> ['required']
        ]);

        if(! auth('web_moderator')->attempt($attributes)) {
            return back()->withInput()->withErrors(['username' => 'Your provided credentials could not be verified.']);
        }

        session()->regenerate();
        return redirect('/moderator/dashboard')->with('success', 'Welcome Back!');
    }

    public function destroy() {
        auth('web_moderator')->logout();
        return redirect('/moderator/dashboard')->with('success', 'Goodbye!');
    }
}
