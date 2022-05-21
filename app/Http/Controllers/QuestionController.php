<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::all();
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
                return view('index', [
                    'questions' => $questions->sortByDesc('created_at')
                ]);
            }
            if(request('question_type') === 'top') {
                return view('index', [
                    'questions' => $questions->sortByDesc(function ($question) {
                        return $question->questionVotes()->sum('vote');
                    })
                ]);
            }
        }
        $tags = Tag::all()->sortBy('id');
        $user_id = auth('web')->id();
        $viewed_questions = $questions->filter(function ($question) use ($user_id) {
            return ($question->questionViews()->where('user_id', $user_id)->exists());
        });
        $questions = $questions->diffAssoc($viewed_questions);
        $viewed_questions->map(function ($viewed_question) {
            $viewed_question->points = [];
        });
        $questions->map(function ($question) {
            $question->points = [];
            $question->distance = 0;
        });
        $viewed_questions->map(function ($viewed_question) use ($tags) {
            foreach ($tags as $tag) {
                if ($viewed_question->tags->contains('id', $tag->id)) {
                    $viewed_question->points = array_merge($viewed_question->points, [1]);
                } else {
                    $viewed_question->points = array_merge($viewed_question->points, [0]);
                }
            }
        });
        $questions->map(function ($question) use ($tags) {
            foreach ($tags as $tag) {
                if($question->tags->contains('id', $tag->id)) {
                    $question->points = array_merge($question->points, [1]);
                }
                else {
                    $question->points = array_merge($question->points, [0]);
                }
            }
        });
        $suggested_questions = collect();
        $viewed_questions_count = $viewed_questions->count();
        $viewed_questions->map(function ($viewed_question) use ($viewed_questions_count, $suggested_questions, $questions) {
            $questions->map(function ($question) use ($viewed_question) {
                $question->distance = 0;
                $pointsDifference = [];
                $i = 0;
                while ($i < count($viewed_question->points) - 10) {
                    $pointsDifference[$i] = pow(($viewed_question->points[$i] - $question->points[$i]), 2);
                    $i++;
                }
                $question->distance = (int)(sqrt(array_sum($pointsDifference)));
            });
            $questions->sortBy(function ($question) {
                return $question->distance;
            });
            $questions = $questions->take($viewed_questions_count);
            $questions->map(function ($question) use ($suggested_questions) {
                $suggested_questions->push($question);
            });
        });
        $suggested_questions = $suggested_questions->unique();
        $suggested_questions->map(function ($question) {
            $question->top_answer = $question->answers->sortByDesc(function ($answer) {
                return $answer->answerVotes()->sum('vote');
            })->first();
            if($question->top_answer) {
                $question->top_answer->upvotes = $question->top_answer->answerVotes()->where('vote', 1)->count();
                $question->top_answer->downvotes = $question->top_answer->answerVotes()->where('vote', -1)->count();
                $question->top_answer->vote = $question->top_answer->answerVotes()->where('user_id', auth('web')->id())->value('vote');
            }
        });
        return view('index', [
            'questions' => $suggested_questions
        ]);
    }

    public function show(Question $question) {
        $question->upvotes = $question->questionVotes()->where('vote', 1)->count();
        $question->downvotes = $question->questionVotes()->where('vote', -1)->count();
        $question->vote = $question->questionVotes()->where('user_id', auth('web')->id())->value('vote');
        $question->answers = $question->answers->sortByDesc(function ($answer) {
            return $answer->answerVotes()->sum('vote');
        });
        $question->answers->map(function ($answer) {
            $answer->upvotes = $answer->answerVotes()->where('vote', 1)->count();
            $answer->downvotes = $answer->answerVotes()->where('vote', -1)->count();
            $answer->vote = $answer->answerVotes()->where('user_id', auth('web')->id())->value('vote');
        });
        $question->answer = $question->answers->where('user_id', auth('web')->id())->first();
        $attributes['question_id'] = $question->id;
        $attributes['user_id'] = auth('web')->id();
        $attributes['views'] = 1;
        if($question->questionViews()->where('user_id', auth('web')->id())->value('views') !== null) {
            $attributes['views'] = $question->questionViews()->where('user_id', auth('web')->id())->value('views') + 1;
            $question->questionViews()->detach($attributes['user_id']);
        }
        $question->questionViews()->attach([$attributes]);
        return view('questions.show', [
            'question' => $question
        ]);
    }

    public function create() {
        return view('questions.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store() {
        $user_id = auth()->user()->id;
        $attributes = request()->validate([
           'title' => ['required', Rule::unique('questions', 'title')],
           'tags' => ['required', Rule::exists('tags', 'slug')],
            'description' => ['required']
        ]);
        $attributes['user_id'] = $user_id;
        $attributes['slug'] = Str::slug(request('title'));
        $question = Question::create($attributes);
        $this->storeTags($question);
        $this->storeFollow($question, $user_id);
        return redirect('/question/'.$question->slug."/show")->with('success', 'Question inserted!');
    }

    public function edit(Question $question) {
        if($question->user->id !== auth('web')->id()) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return view('questions.edit', [
            'question' => $question,
            'tags' => Tag::all(),
            'question_tags' => $question->tags->pluck('slug')->toArray()
        ]);
    }

    public function update(Question $question) {
        $attributes = request()->validate([
            'title' => ['required', Rule::unique('questions', 'title')->ignore($question->id)],
            'tags' => ['required', Rule::exists('tags', 'slug')],
            'description' => ['required']
        ]);
        $attributes['slug'] = Str::slug(request('title'));
        $question->update($attributes);
        $question->tags()->detach();
        $this->storeTags($question);
        return redirect('/question/'.$question->slug."/show")->with('success', 'Question updated!');
    }

    public function destroy(Question $question) {
        $question->delete();
        return redirect('/')->with('success', 'Question deleted!');
    }

    public function follow() {
        $question_slug = request()->validate([
            'question_slug' => ['required', 'exists:questions,slug']
        ]);
        $question = Question::where('slug', $question_slug)->first();
        $attributes['question_id'] = $question->id;
        $attributes['user_id'] = auth('web')->id();
        $question->questionFollowers()->attach([$attributes]);
        return back()->with('success', 'Question followed!');
    }

    public function unfollow() {
        $question_slug = request()->validate([
            'question_slug' => ['required', 'exists:questions,slug']
        ]);
        $question = Question::where('slug', $question_slug)->first();
        $attributes['user_id'] = auth('web')->id();
        $question->questionFollowers()->detach($attributes['user_id']);
        return back()->with('success', 'Question unfollowed!');
    }

    public function upvote() {
        $question_slug = request()->validate([
            'question_slug' => ['required', 'exists:questions,slug']
        ]);
        $question = Question::where('slug', $question_slug)->first();
        $attributes['question_id'] = $question->id;
        $attributes['user_id'] = auth('web')->id();
        if($question->questionVotes()->where('user_id', auth('web')->id())->value('vote') === 1) {
            $question->questionVotes()->detach($attributes['user_id']);
        }
        else {
            $attributes['vote'] = 1;
            if($question->questionVotes()->where('user_id', auth('web')->id())->value('vote') === -1) {
                $question->questionVotes()->detach($attributes['user_id']);
            }
            $question->questionVotes()->attach([$attributes]);
        }
        return back()->with('success', 'Question upvoted!');
    }

    public function downvote() {
        $question_slug = request()->validate([
            'question_slug' => ['required', 'exists:questions,slug']
        ]);
        $question = Question::where('slug', $question_slug)->first();
        $attributes['question_id'] = $question->id;
        $attributes['user_id'] = auth('web')->id();
        if($question->questionVotes()->where('user_id', auth('web')->id())->value('vote') === -1) {
            $question->questionVotes()->detach($attributes['user_id']);
        }
        else {
            $attributes['vote'] = -1;
            if($question->questionVotes()->where('user_id', auth('web')->id())->value('vote') === 1) {
                $question->questionVotes()->detach($attributes['user_id']);
            }
            $question->questionVotes()->attach([$attributes]);
        }
        return back()->with('success', 'Question downvoted!');
    }

    /**
     * @param Question $question
     * @return void
     */
    private function storeTags(Question $question): void
    {
        foreach (request('tags') as $tag_slug) {
            $attributes = null;
            $attributes['question_id'] = $question->id;
            $attributes['tag_id'] = Tag::where('slug', $tag_slug)->first()->id;
            $question->tags()->attach([$attributes]);
        }
    }

    /**
     * @param $question
     * @param $user_id
     * @return void
     */
    private function storeFollow($question, $user_id): void
    {
        $attributes['question_id'] = $question->id;
        $attributes['user_id'] = $user_id;
        $question->questionFollowers()->attach([$attributes]);
    }
}
