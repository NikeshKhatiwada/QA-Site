<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'gender',
        'image',
        'about',
        'address',
        'district',
        'country',
        'timezone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }

    public function followingUsers() {
        return $this->belongsToMany(User::class, 'users_follow_users', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followerUsers() {
        return $this->belongsToMany(User::class, 'users_follow_users', 'following_id', 'follower_id')->withTimestamps();
    }

    public function followingTags() {
        return $this->belongsToMany(Tag::class, 'users_follow_tags', 'user_id', 'tag_id')->withTimestamps();
    }

    public function viewQuestions() {
        return $this->belongsToMany(Question::class, 'users_view_questions', 'user_id', 'question_id')->withTimestamps();
    }

    public function followingQuestions() {
        return $this->belongsToMany(Question::class, 'users_follow_questions', 'user_id', 'question_id')->withTimestamps();
    }

    public function voteQuestions() {
        return $this->belongsToMany(Question::class, 'users_vote_questions', 'user_id', 'question_id');
    }

    public function voteAnswers() {
        return $this->belongsToMany(Answer::class, 'users_vote_answers', 'user_id', 'answer_id');
    }

    public function likeComments() {
        return $this->belongsToMany(Comment::class, 'users_like_comments', 'user_id', 'comment_id');
    }

    public function userReports() {
        return $this->hasMany(Report::class, 'report_about_id')->where('report_about_category', '=', 0);
    }
}
