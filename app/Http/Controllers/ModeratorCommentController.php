<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeratorCommentController extends Controller
{
    public function index() {
        $comments = collect();
        if(request()->has('comment_type')) {
            $comments = Comment::all();
            if(request('comment_type') === 'top') {
                return view('moderators.comments.index', [
                    'comments' => $comments->sortByDesc(function ($comment) {
                        return $comment->commentLikes()->count();
                    })
                ]);
            }
            if(request('comment_type') === 'new') {
                return view('moderators.comments.index', [
                    'comments' => $comments->sortByDesc('created_at')
                ]);
            }
            if(request('comment_type') === 'old') {
                return view('moderators.comments.index', [
                    'comments' => $comments->sortBy('created_at')
                ]);
            }
        }
        if(request()->has('commentId')) {
            request()->validate([
                'commentId' => ['required', Rule::exists('comments', 'id')]
            ]);
            $comment = Comment::find(request('commentId'));
            $comments->add($comment);
        }
        elseif(request()->has('userId')) {
            request()->validate([
                'userId' => ['required', Rule::exists('users', 'id')]
            ]);
            $user = User::find(request('userId'));
            $user_comments = $user->comments->sortByDesc(function ($comment) {
                return $comment->commentLikes()->count();
            });
            $comments = $user_comments;
        }
        elseif(request()->has('answerId')) {
            request()->validate([
                'answerId' => ['required', Rule::exists('answers', 'id')]
            ]);
            $answer = Answer::find(request('answerId'));
            $answer_comments = $answer->comments->sortByDesc(function ($comment) {
                return $comment->commentLikes()->count();
            });
            $comments = $answer_comments;
        }
        elseif(request()->has('reportId')) {
            request()->validate([
                'reportId' => ['required', Rule::exists('reports', 'id')]
            ]);
            $report = Report::find(request('reportId'));
            if($report->report_about_category === 3) {
                $report_comment = $report->reportedComment;
                $comments->add($report_comment);
            }
        }
        else {
            $comments = Comment::all();
        }
        return view('moderators.comments.index', [
            'comments' => $comments
        ]);
    }
}
