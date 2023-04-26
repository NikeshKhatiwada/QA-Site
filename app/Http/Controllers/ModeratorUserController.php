<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeratorUserController extends Controller
{
    public function index() {
        $users = collect();
        if(request()->has('user_type')) {
            $users = User::all();
            if(request('user_type') === 'top') {
                return view('moderators.users.index', [
                    'users' => $users->sortByDesc(function ($user) {
                        return $user->followerUsers->count();
                    })
                ]);
            }
            if(request('user_type') === 'new') {
                return view('moderators.users.index', [
                    'users' => $users->sortByDesc('created_at')
                ]);
            }
            if(request('user_type') === 'old') {
                return view('moderators.users.index', [
                    'users' => $users->sortBy('created_at')
                ]);
            }
        }
        if(request()->has('userId')) {
            request()->validate([
                'userId' => ['required', Rule::exists('users', 'id')]
            ]);
            $user = User::find(request('userId'));
            $users->add($user);
        }
        elseif(request()->has('questionId')) {
            request()->validate([
                'questionId' => ['required', Rule::exists('questions', 'id')]
            ]);
            $question = Question::find(request('questionId'));
            $question_user = $question->user;
            $users->add($question_user);
        }
        elseif(request()->has('answerId')) {
            request()->validate([
                'answerId' => ['required', Rule::exists('answers', 'id')]
            ]);
            $answer = Answer::find(request('answerId'));
            $answer_user = $answer->user;
            $users->add($answer_user);
        }
        elseif(request()->has('commentId')) {
            request()->validate([
                'commentId' => ['required', Rule::exists('comments', 'id')]
            ]);
            $comment = Comment::find(request('commentId'));
            $comment_user = $comment->answer;
            $users->add($comment_user);
        }
        elseif(request()->has('reportId')) {
            request()->validate([
                'reportId' => ['required', Rule::exists('reports', 'id')]
            ]);
            $report = Report::find(request('reportId'));
            if($report->report_about_category === 0) {
                $report_user = $report->reportedUser;
                $users->add($report_user);
            }
        }
        else {
            $users = User::all();
        }
        return view('moderators.users.index', [
            'users' => $users
        ]);
    }

    public function suspend() {
        $attributes = request()->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'suspended_till' => ['required']
        ]);
        $user = User::find(request('user_id'));
        $user->update(['suspended_until' => request('suspended_till')]);
        return back()->with('success', 'User suspended successfully!');
    }

    public function unsuspend() {
        $attributes = request()->validate([
            'user_id' => ['required', Rule::exists('users', 'id')]
        ]);
        $user = User::find(request('user_id'));
        $user->suspended_until = null;
        $user->save();
        return back()->with('success', 'User unsuspended successfully!');
    }
}
