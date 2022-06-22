<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Report;
use App\Models\ReportCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    public function create() {
        $item_categories = ['user', 'question', 'answer', 'comment', 'tag'];
        $reportAbout = collect();
        $attributes = request()->validate([
            'itemCategory' => ['required', Rule::in($item_categories)],
            'itemId' => ['required']
        ]);
        if (request('itemCategory') === 'user') {
            request()->validate([
                'itemId' => [Rule::exists('users', 'id')]
            ]);
            $reportAbout->title = User::find(request('itemId'))->get('first_name') . User::find(request('itemId'))->get('last_name');
        }
        if (request('itemCategory') === 'question') {
            request()->validate([
                'itemId' => [Rule::exists('questions', 'id')]
            ]);
            $reportAbout->title = substr(Question::find(request('itemId'))->get('title'), 0, 200) . "...";
        }
        if (request('itemCategory') === 'answer') {
            request()->validate([
                'itemId' => [Rule::exists('answers', 'id')]
            ]);
            $reportAbout->title = substr(Answer::find(request('itemId'))->get('description'), 0, 200) . "...";
        }
        if (request('itemCategory') === 'comment') {
            request()->validate([
                'itemId' => [Rule::exists('comment', 'id')]
            ]);
            $reportAbout->title = substr(Comment::find(request('itemId'))->get('description'), 0, 200) . "...";
        }
        if (request('itemCategory') === 'tag') {
            request()->validate([
                'itemId' => [Rule::exists('tags', 'id')]
            ]);
            $reportAbout->title = Tag::find(request('itemId'))->get('title');
        }
        $reportAbout->category = ucwords(request('itemCategory'));
        $reportAbout->id = request('itemId');
        return view('reports.create', [
            'reportAbout' => $reportAbout,
            'categories' => ReportCategory::all()
        ]);
    }
    public function store() {
        $user_id = auth('web')->user()->id;
        $item_categories = ['user', 'question', 'answer', 'comment', 'tag'];
        $attributes = request()->validate([
            'reported-item-category' => ['required', Rule::in($item_categories)],
            'reported-item-id' => ['required'],
            'category' => ['required', Rule::exists('report_categories', 'name')],
            'description' => ['required']
        ]);
        $attributes['user_id'] = $user_id;
        $attributes['report_category_id'] = ReportCategory::where('name', request('category'))->first()->id;
        if (request('reported-item-category') === 'user') {
            request()->validate([
                'reported-item-id' => [Rule::exists('users', 'id')]
            ]);
            $attributes['report_about_category'] = 0;
        }
        if (request('reported-item-category') === 'question') {
            request()->validate([
                'reported-item-id' => [Rule::exists('questions', 'id')]
            ]);
            $attributes['report_about_category'] = 1;
        }
        if (request('reported-item-category') === 'answer') {
            request()->validate([
                'reported-item-id' => [Rule::exists('answers', 'id')]
            ]);
            $attributes['report_about_category'] = 2;
        }
        if (request('reported-item-category') === 'comment') {
            request()->validate([
                'reported-item-id' => [Rule::exists('comment', 'id')]
            ]);
            $attributes['report_about_category'] = 3;
        }
        if (request('reported-item-category') === 'tag') {
            request()->validate([
                'reported-item-id' => [Rule::exists('tags', 'id')]
            ]);
            $attributes['report_about_category'] = 10;
        }
        $attributes['report_about_id'] = request('reported-item-id');
        Report::create($attributes);
        return back()->with('success', 'Report inserted!');
    }
}
