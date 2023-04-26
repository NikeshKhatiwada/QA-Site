<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_category_id',
        'report_about_id',
        'report_about_category',
        'report_description',
    ];

    protected $with = [
        'reportCategory'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reportCategory() {
        return $this->belongsTo(ReportCategory::class);
    }

    public function reportedUser() {
        return $this->belongsTo(User::class, 'report_about_id');
    }

    public function reportedQuestion() {
        return $this->belongsTo(Question::class, 'report_about_id');
    }

    public function reportedAnswer() {
        return $this->belongsTo(Answer::class, 'report_about_id');
    }

    public function reportedComments() {
        return $this->belongsTo(Comment::class, 'report_about_id');
    }

    public function reportedTags() {
        return $this->belongsTo(Tag::class, 'report_about_id');
    }
}
