<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'description',
    ];

    protected $with = [
        'user',
        'question'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function answerVotes() {
        return $this->belongsToMany(User::class, 'users_vote_answers', 'answer_id', 'user_id');
    }

    public function answerReports() {
        return $this->hasMany(Report::class, 'report_about_id')->where('report_about_category', '=', 2);
    }
}
