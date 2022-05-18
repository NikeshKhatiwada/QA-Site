<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('index', [
            'questions' => $questions->sortBy('slug')
        ]);
    }
}
