<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_about_id',
        'report_about_category',
        'report_category',
        'report_description',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reportedUsers() {
        return $this->belongsTo(User::class, 'report_about_id')->where('report_about_category', '=', 0);
    }

    public function reportedQuestions() {
        return $this->belongsTo(Question::class, 'report_about_id')->where('report_about_category', '=', 1);
    }

    public function reportedAnswers() {
        return $this->belongsTo(Answer::class, 'report_about_id')->where('report_about_category', '=', 2);
    }

    public function reportedComments() {
        return $this->belongsTo(Comment::class, 'report_about_id')->where('report_about_category', '=', 3);
    }
}
