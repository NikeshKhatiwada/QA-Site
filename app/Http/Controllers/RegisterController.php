<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create() {
        return view('users.registers.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store() {
        $attributes = request()->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'first-name' => ['required'],
            'last-name' => ['required'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'image' => ['required', 'image'],
            'tags' => ['required', Rule::exists('tags', 'slug')],
            'address' => ['required'],
            'district' => ['required'],
            'country' => ['required'],
            'timezone' => ['required'],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed']
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
            request()->file('image')->store('images/users');
            $attributes['image'] = request()->file('image')->hashName();
        }
        $user = User::create($attributes);
        $this->storeTagsFollow($user);
        return redirect('/')->with('success', 'Profile created!');
    }

    /**
     * @param User $user
     * @return void
     */
    private function storeTagsFollow(User $user): void
    {
        foreach (request('tags') as $tag_slug) {
            $attributes = null;
            $attributes['user_id'] = $user->id;
            $attributes['tag_id'] = Tag::where('slug', $tag_slug)->first()->id;
            $user->followingTags()->attach([$attributes]);
        }
    }
}
