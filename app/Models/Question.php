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
        'user',
        'tag'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'questions_tags', 'tag_id', 'question_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function questionFollowers() {
        return $this->belongsToMany(User::class, 'users_follow_questions', 'user_id', 'question_id');
    }

    public function questionVotes() {
        return $this->belongsToMany(Question::class, 'users_vote_questions', 'user_id', 'question_id');
    }
}
