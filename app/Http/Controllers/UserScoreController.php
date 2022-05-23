<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserScoreController extends Controller
{
    public function update($user_id, $score) {
        $user = User::find($user_id);
        $attributes['score'] = $user->score + $score;
        $user->update($attributes);
    }
}
