<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function upvote() {
        request()->validate([
            'user_username' => ['required', 'exists:users,username'],
            'question_slug' => ['required', 'exists:questions,slug']
        ]);
        $user_id = User::where('username', request('user_username'))->first()->id;
        $question_id = Question::where('slug', request('question_slug'))->first()->id;
        $answer = Answer::where('user_id', $user_id)->where('question_id', $question_id)->first();
        $attributes['answer_id'] = $answer->id;
        $attributes['user_id'] = auth('web')->id();
        if($answer->answerVotes()->where('user_id', auth('web')->id())->value('vote') === 1) {
            $answer->answerVotes()->detach($attributes['user_id']);
        }
        else {
            $attributes['vote'] = 1;
            if($answer->answerVotes()->where('user_id', auth('web')->id())->value('vote') === -1) {
                $answer->answerVotes()->detach($attributes['user_id']);
            }
            $answer->answerVotes()->attach([$attributes]);
        }
        return back()->with('success', 'Answer upvoted!');
    }

    public function downvote() {
        request()->validate([
            'user_username' => ['required', 'exists:users,username'],
            'question_slug' => ['required', 'exists:questions,slug']
        ]);
        $user_id = User::where('username', request('user_username'))->first()->id;
        $question_id = Question::where('slug', request('question_slug'))->first()->id;
        $answer = Answer::where('user_id', $user_id)->where('question_id', $question_id)->first();
        $attributes['answer_id'] = $answer->id;
        $attributes['user_id'] = auth('web')->id();
        if($answer->answerVotes()->where('user_id', auth('web')->id())->value('vote') === -1) {
            $answer->answerVotes()->detach($attributes['user_id']);
        }
        else {
            $attributes['vote'] = -1;
            if($answer->answerVotes()->where('user_id', auth('web')->id())->value('vote') === 1) {
                $answer->answerVotes()->detach($attributes['user_id']);
            }
            $answer->answerVotes()->attach([$attributes]);
        }
        return back()->with('success', 'Answer downvoted!');
    }
}
