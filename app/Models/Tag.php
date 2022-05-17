<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'image',
    ];

    public function questions() {
        return $this->belongsToMany(Question::class, 'questions_tags', 'tag_id', 'question_id');
    }

    public function tagFollowers() {
        return $this->belongsToMany(User::class, 'users_follow_tags', 'tag_id', 'user_id')->withTimestamps();
    }
}
