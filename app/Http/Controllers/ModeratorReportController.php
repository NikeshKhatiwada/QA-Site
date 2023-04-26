<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeratorReportController extends Controller
{
    public function index() {
        $reports = collect();
        if(request()->has('report_type')) {
            if (request('report_type') === 'all') {
                $reports = Report::all();
                return view('moderators.reports.index', [
                    'reports' => $reports->sortByDesc(function ($report) {
                        return $report->created_at;
                    })
                ]);
            }
            if (request('report_type') === 'unreviewed') {
                $reports = Report::where('report_status', 'U')->get();
                return view('moderators.reports.index', [
                    'reports' => $reports->sortByDesc(function ($report) {
                        return $report->updated_at;
                    })
                ]);
            }
            if (request('report_type') === 'reviewed') {
                $reports = Report::where('report_status', 'G')->orWhere('report_status', 'D')->get();
                return view('moderators.reports.index', [
                    'reports' => $reports->sortByDesc(function ($report) {
                        return $report->updated_at;
                    })
                ]);
            }
        }
        if(request()->has('reportId')) {
            request()->validate([
                'reportId' => ['required', Rule::exists('reports', 'id')]
            ]);
            $report = Report::find(request('reportId'));
            $reports->add($report);
        }
        elseif(request()->has('userId')) {
            request()->validate([
                'userId' => ['required', Rule::exists('users', 'id')]
            ]);
            $user = User::find(request('userId'));
            $user_reports = $user->userReports;
            $reports = $user_reports;
        }
        elseif(request()->has('questionId')) {
            request()->validate([
                'questionId' => ['required', Rule::exists('questions', 'id')]
            ]);
            $question = Question::find(request('questionId'));
            $question_reports = $question->questionReports;
            $reports = $question_reports;
        }
        elseif(request()->has('answerId')) {
            request()->validate([
                'answerId' => ['required', Rule::exists('answers', 'id')]
            ]);
            $answer = Answer::find(request('answerId'));
            $answer_reports = $answer->reports;
            $reports = $answer_reports;
        }
        elseif(request()->has('commentId')) {
            request()->validate([
                'commentId' => ['required', Rule::exists('comments', 'id')]
            ]);
            $comment = Comment::find(request('commentId'));
            $comment_reports = $comment->reports;
            $reports = $comment_reports;
        }
        else {
            $reports = Report::all();
        }
        return view('moderators.reports.index', [
            'reports' => $reports->sortByDesc(function ($report) {
                return $report->created_at;
            })
        ]);
    }
}
