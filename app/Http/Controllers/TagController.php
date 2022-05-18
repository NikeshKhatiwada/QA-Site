<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        if(request()->has('tag_type'))
        {
            $tags = Tag::all();
            if(request('tag_type') === 'new') {
                foreach ($tags as $tag) {
                    $tag->questions = $tag->questions->sortByDesc('created_at');
                }
                return view('tags.index', [
                    'tags' => $tags->sortByDesc(function ($tag) {
                        return $tag->questions->first()->created_at??"";
                    })
                ]);
            }
            elseif(request('tag_type') === 'top') {
                return view('tags.index', [
                    'tags' => $tags->sortByDesc(function ($tag) {
                        return $tag->questions->count();
                    })
                ]);
            }
        }
        return view('tags.index', [
            'tags' => Tag::all()->sortBy('slug')
        ]);
    }

    public function show(Tag $tag) {
        $questions = $tag->questions;
        $questions->map(function ($question) {
           $question->top_answer = $question->answers->sortByDesc(function ($answer) {
               return $answer->answerVotes()->sum('vote');
           })->first();
           if($question->top_answer) {
               $question->top_answer->upvotes = $question->top_answer->answerVotes()->where('vote', 1)->count();
               $question->top_answer->downvotes = $question->top_answer->answerVotes()->where('vote', -1)->count();
               $question->top_answer->vote = $question->top_answer->answerVotes()->where('user_id', auth('web')->id())->value('vote');
           }
        });
        if(request()->has('question_type'))
        {
            if(request('question_type') === 'new') {
                return view('tags.show', [
                    'tag' => $tag,
                    'questions' => $questions->sortByDesc('created_at')
                ]);
            }
            if(request('question_type') === 'top') {
                return view('tags.show', [
                    'tag' => $tag,
                    'questions' => $questions->sortByDesc(function ($question) {
                        return $question->questionVotes()->sum('vote');
                    })
                ]);
            }
        }
        return view('tags.show', [
            'tag' => $tag,
            'questions' => $questions->sortBy('slug')
        ]);
    }

    public function create() {
        return view('tags.create');
    }

    public function edit() {
        return view('tags.edit');
    }

    public function follow(Tag $tag) {
        $tag_slug = request()->validate([
            'tag_slug' => ['required', 'exists:tags,slug']
        ]);
        $tag = Tag::where('slug', $tag_slug)->first();
        $attributes['tag_id'] = $tag->id;
        $attributes['user_id'] = auth('web')->id();
        $tag->tagFollowers()->attach([$attributes]);
        return back()->with('success', 'Tag followed!');
    }
    public function unfollow(Tag $tag) {
        $tag_slug = request()->validate([
            'tag_slug' => ['required', 'exists:tags,slug']
        ]);
        $tag = Tag::where('slug', $tag_slug)->first();
        $attributes['user_id'] = auth('web')->id();
        $tag->tagFollowers()->detach($attributes['user_id']);
        return back()->with('success', 'Tag unfollowed!');
    }
}
