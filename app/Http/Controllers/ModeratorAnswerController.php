<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeratorAnswerController extends Controller
{
    public function index() {
        $answers = collect();
        if(request()->has('answer_type')) {
            $answers = Answer::all();
            if(request('answer_type') === 'top') {
                return view('moderators.answers.index', [
                    'answers' => $answers->sortByDesc(function ($answer) {
                        return $answer->answerVotes()->sum('vote');
                    })
                ]);
            }
            if(request('answer_type') === 'new') {
                return view('moderators.answers.index', [
                    'answers' => $answers->sortByDesc('created_at')
                ]);
            }
            if(request('answer_type') === 'old') {
                return view('moderators.answers.index', [
                    'answers' => $answers->sortBy('created_at')
                ]);
            }
        }
        if(request()->has('answerId')) {
            request()->validate([
                'answerId' => ['required', Rule::exists('answers', 'id')]
            ]);
            $answer = Answer::find(request('answerId'));
            $answers->add($answer);
        }
        elseif(request()->has('userId')) {
            request()->validate([
                'userId' => ['required', Rule::exists('users', 'id')]
            ]);
            $user = User::find(request('userId'));
            $user_answers = $user->answers->sortByDesc(function ($answer) {
                return $answer->answerVotes()->sum('vote');
            });
            $answers = $user_answers;
        }
        elseif(request()->has('questionId')) {
            request()->validate([
                'questionId' => ['required', Rule::exists('questions', 'id')]
            ]);
            $question = Question::find(request('questionId'));
            $question_answers = $question->answers->sortByDesc(function ($answer) {
                return $answer->answerVotes()->sum('vote');
            });
            $answers = $question_answers;
        }
        elseif(request()->has('commentId')) {
            request()->validate([
                'commentId' => ['required', Rule::exists('comments', 'id')]
            ]);
            $comment = Comment::find(request('commentId'));
            $comment_answer = $comment->answer;
            $answers->add($comment_answer);
        }
        elseif(request()->has('reportId')) {
            request()->validate([
                'reportId' => ['required', Rule::exists('reports', 'id')]
            ]);
            $report = Report::find(request('reportId'));
            if($report->report_about_category === 2) {
                $report_answer = $report->reportedAnswer;
                $answers->add($report_answer);
            }
        }
        else {
            $answers = Answer::all();
        }
        return view('moderators.answers.index', [
            'answers' => $answers
        ]);
    }
}
