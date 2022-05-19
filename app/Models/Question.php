<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
    ];

    protected $with = [
        'user'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'questions_tags', 'question_id', 'tag_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function questionFollowers() {
        return $this->belongsToMany(User::class, 'users_follow_questions', 'question_id', 'user_id')->withTimestamps();
    }

    public function questionVotes() {
        return $this->belongsToMany(User::class, 'users_vote_questions', 'question_id', 'user_id')->withTimestamps();
    }

    public function questionReports() {
        return $this->hasMany(Report::class, 'report_about_id')->where('report_about_category', '=', 1);
    }
}
