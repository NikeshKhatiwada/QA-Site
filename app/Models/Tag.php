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
        return $this->belongsToMany(Question::class, 'questions_tags', 'question_id', 'tag_id');
    }

    public function tagFollowers() {
        return $this->belongsToMany(User::class, 'users_follow_tags', 'user_id', 'tag_id');
    }
}
