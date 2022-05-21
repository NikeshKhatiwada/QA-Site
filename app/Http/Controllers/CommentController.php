<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store() {
        $attributes = request()->validate([
            'user_username' => ['required', 'exists:users,username'],
            'question_slug' => ['required', 'exists:questions,slug'],
            'comment-description' => ['required']
        ]);
        $user_id = User::where('username', request('user_username'))->first()->id;
        $question_id = Question::where('slug', request('question_slug'))->first()->id;
        $answer_id = Answer::where('user_id', $user_id)->where('question_id', $question_id)->first()->id;
        $attributes['answer_id'] = $answer_id;
        $attributes['user_id'] = auth('web')->id();
        $attributes['description'] = request('comment-description');
        Comment::create($attributes);
        return back()->with('success', 'Comment inserted!');
    }

    public function update(Comment $comment) {
        $attributes = request()->validate([
            'comment-edit-description' => ['required']
        ]);
        $attributes['description'] = request('comment-edit-description');
        $comment->update($attributes);
        return back()->with('success', 'Comment updated!');
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return back()->with('success', 'Comment deleted!');
    }

    public function like() {
        $comment_id = request()->validate([
            'comment_id' => ['required', 'exists:comments,id']
        ]);
        $comment = Comment::where('id', $comment_id)->first();
        $attributes['comment_id'] = $comment->id;
        $attributes['user_id'] = auth('web')->id();
        $message = 'Comment liked';
        if($comment->commentLikes()->where('user_id', auth('web')->id())->value('like') === 1) {
            $comment->commentLikes()->detach($attributes['user_id']);
        }
        else {
            $attributes['like'] = 1;
            $comment->commentLikes()->attach([$attributes]);
            $message = 'Comment unliked';
        }
        return back()->with('success', $message);
    }
}
