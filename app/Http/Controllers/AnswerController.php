<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Question $question) {
        $attributes = $this->getAttributes($question);
        if(Answer::where('user_id', auth('web')->id())->where('question_id', $question->id)->exists()) {
            return back()->withInput()->withErrors(['answer-description' => 'You have already posted answer to this question.']);
        }
        Answer::create($attributes);
        return back()->with('success', 'Answer inserted!');
    }

    public function update(Question $question) {
        $attributes = $this->getAttributes($question);
        $answer = Answer::where('user_id', auth('web')->id())->where('question_id', $question->id)->first();
        $answer->update($attributes);
        return back()->with('success', 'Answer updated!');
    }

    public function destroy(Question $question) {
        $answer = Answer::where('user_id', auth('web')->id())->where('question_id', $question->id)->first();
        $answer->delete();
        return back()->with('success', 'Answer deleted!');
    }

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

    /**
     * @param Question $question
     * @return array
     */
    private function getAttributes(Question $question): array
    {
        $attributes = request()->validate([
            'answer-description' => ['required']
        ]);
        $attributes['question_id'] = $question->id;
        $attributes['user_id'] = auth('web')->id();
        $attributes['description'] = request('answer-description');
        return $attributes;
    }
}
