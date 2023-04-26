<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Report;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeratorTagController extends Controller
{
    public function index() {
        $tags = collect();
        if(request()->has('comment_type')) {
            $tag = Tag::all();
            if(request('tag_type') === 'top') {
                return view('moderators.tags.index', [
                    'tags' => $tags->sortByDesc(function ($tag) {
                        return $tag->tagFollowers()->count();
                    })
                ]);
            }
            if(request('tag_type') === 'new') {
                return view('moderators.tags.index', [
                    'tags' => $tags->sortByDesc('created_at')
                ]);
            }
            if(request('tag_type') === 'old') {
                return view('moderators.tags.index', [
                    'comments' => $tags->sortBy('created_at')
                ]);
            }
        }
        if(request()->has('tagId')) {
            request()->validate([
                'tagId' => ['required', Rule::exists('tags', 'id')]
            ]);
            $tag = Tag::find(request('tagId'));
            $tags->add($tag);
        }
        elseif(request()->has('questionId')) {
            request()->validate([
                'questionId' => ['required', Rule::exists('questions', 'id')]
            ]);
            $question = Question::find(request('questionId'));
            $question_tags = $question->tags;
            $tags = $question_tags;
        }
        elseif(request()->has('reportId')) {
            request()->validate([
                'reportId' => ['required', Rule::exists('reports', 'id')]
            ]);
            $report = Report::find(request('reportId'));
            if($report->report_about_category === 10) {
                $report_tag = $report->reportedTag;
                $tags->add($report_tag);
            }
        }
        else {
            $tags = Tag::all();
        }
        return view('moderators.tags.index', [
            'tags' => $tags
        ]);
    }
}
