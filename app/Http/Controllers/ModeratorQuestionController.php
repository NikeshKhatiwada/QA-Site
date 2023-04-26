<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Report;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeratorQuestionController extends Controller
{
    public function index() {
        $questions = collect();
        if(request()->has('question_type')) {
            $questions = Question::all();
            if(request('question_type') === 'top') {
                return view('moderators.questions.index', [
                    'questions' => $questions->sortByDesc(function ($question) {
                        return $question->questionVotes()->sum('vote');
                    })
                ]);
            }
            if(request('question_type') === 'new') {
                return view('moderators.questions.index', [
                    'questions' => $questions->sortByDesc('created_at')
                ]);
            }
            if(request('question_type') === 'old') {
                return view('moderators.questions.index', [
                    'questions' => $questions->sortBy('created_at')
                ]);
            }
        }
        if(request()->has('questionId')) {
            request()->validate([
                'questionId' => ['required', Rule::exists('questions', 'id')]
            ]);
            $question = Question::find(request('questionId'));
            $questions->add($question);
        }
        elseif(request()->has('userId')) {
            request()->validate([
                'userId' => ['required', Rule::exists('users', 'id')]
            ]);
            $user = User::find(request('userId'));
            $user_questions = $user->questions->sortByDesc(function ($question) {
                return $question->questionVotes()->sum('vote');
            });
            $questions = $user_questions;
        }
        elseif(request()->has('answerId')) {
            request()->validate([
                'answerId' => ['required', Rule::exists('answers', 'id')]
            ]);
            $answer = Answer::find(request('answerId'));
            $answer_question = $answer->question;
            $questions->add($answer_question);
        }
        elseif(request()->has('tagId')) {
            request()->validate([
                'tagId' => ['required', Rule::exists('tags', 'id')]
            ]);
            $tag = Tag::find(request('tagId'));
            $tag_questions = $tag->questions->sortByDesc(function ($question) {
                return $question->questionVotes()->sum('vote');
            });
            $questions = $tag_questions;
        }
        elseif(request()->has('reportId')) {
            request()->validate([
                'reportId' => ['required', Rule::exists('reports', 'id')]
            ]);
            $report = Report::find(request('reportId'));
            if($report->report_about_category === 1) {
                $report_question = $report->reportedQuestion;
                $questions->add($report_question);
            }
        }
        else {
            $questions = Question::all();
        }
        return view('moderators.questions.index', [
            'questions' => $questions
        ]);
    }
}
