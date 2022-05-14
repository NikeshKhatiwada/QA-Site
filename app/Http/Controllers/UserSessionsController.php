<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSessionsController extends Controller
{
    public function create() {
        return view('users.sessions.create');
    }

    public function store() {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password'=> ['required']
        ]);

        if(! auth('web')->attempt($attributes)) {
            return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified.']);
        }

        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy() {
        auth('web')->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
