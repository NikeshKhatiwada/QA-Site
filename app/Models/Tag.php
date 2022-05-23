<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_category_id',
        'slug',
        'title',
        'description',
        'image',
    ];

    protected $with = [
        'tag_category'
    ];

    public function tagCategory() {
        return $this->belongsTo(Tag::class);
    }

    public function questions() {
        return $this->belongsToMany(Question::class, 'questions_tags', 'tag_id', 'question_id');
    }

    public function tagFollowers() {
        return $this->belongsToMany(User::class, 'users_follow_tags', 'tag_id', 'user_id')->withTimestamps();
    }

    public function tagReports() {
        return $this->hasMany(Report::class, 'report_about_id')->where('report_about_category', '=', 10);
    }
}
