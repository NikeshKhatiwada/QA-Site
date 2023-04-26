<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        if(request()->has('user_type'))
        {
            if(request('user_type') === 'top') {
                return view('users.index', [
                    'users' => User::all()->sortByDesc(function ($user) {
                        return $user->followerUsers->count();
                    })
                ]);
            }
            if(request('user_type') === 'new') {
                return view('users.index', [
                    'users' => User::all()->sortByDesc('created_at')
                ]);
            }
            elseif(request('user_type') === 'old') {
                return view('users.index', [
                    'users' => User::all()->sortBy('created_at')
                ]);
            }
        }
        return view('users.index', [
            'users' => User::all()->sortBy('username')
        ]);
    }

    public function show(User $user) {
        $questions = $user->questions->sortByDesc('created_at');
        $answers = $user->answers->sortByDesc('created_at');
        if(request()->has('qORa')) {
            if(request('qORa') == 'questions') {
                $questions->map(function ($question) {
                    $question->answer = $question->answers->sortByDesc(function ($answer) {
                        return $answer->answerVotes()->sum('vote');
                    })->first();
                    $this->answerInfo($question);
                });
            }
            if(request('qORa') == 'answers') {
                $questions = $answers->map(function ($answer) {
                        return $answer->question;
                });
                $questions->map(function ($question) use ($answers) {
                    $question->answer = $answers->where('question_id', $question->id)->first();
                    $this->answerInfo($question);
                });
            }
            return view('users.show', [
                'user' => $user,
                'questions' => $questions
            ]);
        }
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function follow(User $user) {
        $user_username = request()->validate([
            'user_username' => ['required', 'exists:users,username']
        ]);
        $user = User::where('username', $user_username)->first();
        $attributes['following_id'] = $user->id;
        $attributes['follower_id'] = auth('web')->id();
        $user->followerUsers()->attach([$attributes]);
        return back()->with('success', 'User followed!');
    }
    public function unfollow(User $user) {
        $user_username = request()->validate([
            'user_username' => ['required', 'exists:users,username']
        ]);
        $user = User::where('username', $user_username)->first();
        $attributes['user_id'] = auth('web')->id();
        $user->followerUsers()->detach($attributes['user_id']);
        return back()->with('success', 'User unfollowed!');
    }

    /**
     * @param $question
     * @return void
     */
    private function answerInfo($question): void
    {
        if ($question->answer) {
            $question->answer->upvotes = $question->answer->answerVotes()->where('vote', 1)->count();
            $question->answer->downvotes = $question->answer->answerVotes()->where('vote', -1)->count();
            $question->answer->vote = $question->answer->answerVotes()->where('user_id', auth('web')->id())->value('vote');
        }
    }
}
