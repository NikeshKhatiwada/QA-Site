<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'answer_id',
        'description',
    ];

    protected $with = [
        'user',
        'answer'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answer() {
        return $this->belongsTo(Answer::class);
    }

    public function commentLikes() {
        return $this->belongsToMany(User::class, 'users_like_comments', 'comment_id', 'user_id');
    }

    public function answerReports() {
        return $this->hasMany(Report::class, 'report_about_id')->where('report_about_category', '=', 3);
    }
}
