<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show() {
        return view('users.profiles.show', [
            'user' => auth('web')->user()
        ]);
    }

    public function create() {
        return view('users.profiles.create');
    }

    public function edit() {
        return view('users.profiles.edit', [
            'user' => auth('web')->user()
        ]);
    }

    public function editPassword() {
        return view('users.profiles.passwords.edit');
    }

    public function update() {
        $user = auth('web')->user();
        $attributes = request()->validate([
            'username' => ['required', Rule::unique('users', 'username')->ignore($user->id)],
            'first-name' => ['required'],
            'last-name' => ['required'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'image' => $user->exists ? ['image'] : ['required', 'image'],
            'address' => ['required'],
            'district' => ['required'],
            'country' => ['required'],
            'timezone' => ['required'],
            'email' => ['required']
        ]);
        $attributes['first_name'] = $attributes['first-name'];
        $attributes['last_name'] = $attributes['last-name'];
        if($attributes['gender']==='male') {
            $attributes['gender'] = 0;
        }
        elseif($attributes['gender']==='female') {
            $attributes['gender'] = 1;
        }
        $attributes['about'] = request('about');
        if(isset($attributes['image'])) {
            unlink('storage/images/users/'.$user->image);
            request()->file('image')->store('images/users');
            $attributes['image'] = request()->file('image')->hashName();
        }
        $user->update($attributes);
        return redirect('/profile/show')->with('success', 'Profile updated!');
    }

    public function updatePassword() {
        $user = auth('web')->user();
        request()->validate([
            'current-password' => ['required', 'current_password:web'],
            'new-password' => ['required', 'confirmed']
        ]);
        $user->update(['password' => request('new-password')]);
        return redirect('/profile/show')->with('success', 'Password updated!');
    }
}
