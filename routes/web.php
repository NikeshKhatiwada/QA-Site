<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ModeratorAnswerController;
use App\Http\Controllers\ModeratorCommentController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ModeratorQuestionController;
use App\Http\Controllers\ModeratorReportController;
use App\Http\Controllers\ModeratorSessionsController;
use App\Http\Controllers\ModeratorTagController;
use App\Http\Controllers\ModeratorUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserSessionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth:web')->group(function () {
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/home', 'index');
        Route::get('/search', 'search');
        Route::get('/question/{question:slug}/show', 'show');
        Route::get('/questions/create', 'create');
        Route::post('/questions', 'store');
        Route::get('/question/{question:slug}/edit', 'edit');
        Route::patch('/question/{question:slug}', 'update');
        Route::delete('/question/{question:slug}', 'destroy');
        Route::post('/question/follow', 'follow');
        Route::post('/question/unfollow', 'unfollow');
        Route::post('/question/upvote', 'upvote');
        Route::post('/question/downvote', 'downvote');
    });

    Route::controller(AnswerController::class)->group(function () {
        Route::post('/answers/{question:slug}', 'store');
        Route::patch('/answer/{question:slug}', 'update');
        Route::delete('/answer/{question:slug}', 'destroy');
        Route::post('/answer/upvote', 'upvote');
        Route::post('/answer/downvote', 'downvote');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('/comments', 'store');
        Route::patch('/comment/{comment:id}', 'update');
        Route::delete('/comment/{comment:id}', 'destroy');
        Route::post('/comment/like', 'like');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get('/tags', 'index');
        Route::get('/tag/{tag:slug}/show', 'show');
        Route::get('/tags/create', 'create');
        Route::post('/tags', 'store');
        Route::get('/tags/{tag:slug}/edit', 'edit');
        Route::patch('/tag/{tag:slug}', 'update');
        Route::post('/tag/follow', 'follow');
        Route::post('/tag/unfollow', 'unfollow');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/user/{user:username}/show', 'show');
        Route::post('/user/follow', 'follow');
        Route::post('/user/unfollow', 'unfollow');
    });

    Route::controller(UserProfileController::class)->group(function() {
        Route::get('/profile/show', 'show');
        Route::get('/profile/edit', 'edit');
        Route::get('/profile/edit-password', 'editPassword');
        Route::patch('/profile', 'update');
        Route::patch('/profile/password', 'updatePassword');
        Route::delete('/profile', 'delete');
    });

    Route::controller(ReportController::class)->group(function() {
        Route::get('/reports/create', 'create');
    });
});

Route::middleware('auth:web_moderator')->group( function () {
    Route::controller(ModeratorController::class)->group(function () {
        Route::get('/moderator/dashboard', 'index');
        Route::get('/moderator/home', 'index');
    });

    Route::controller(ModeratorUserController::class)->group(function () {
        Route::get('/moderator/users', 'index');
        Route::post('/moderator/user/suspend', 'suspend');
        Route::post('/moderator/user/unsuspend', 'unsuspend');
    });

    Route::controller(ModeratorQuestionController::class)->group(function () {
        Route::get('/moderator/questions', 'index');
    });

    Route::controller(ModeratorAnswerController::class)->group(function () {
        Route::get('/moderator/answers', 'index');
    });

    Route::controller(ModeratorCommentController::class)->group(function () {
        Route::get('/moderator/comments', 'index');
    });

    Route::controller(ModeratorTagController::class)->group(function () {
        Route::get('/moderator/tags', 'index');
    });

    Route::controller(ModeratorReportController::class)->group(function () {
        Route::get('/moderator/reports', 'index');
    });
});

Route::get('/login', [UserSessionsController::class, 'create'])->name('login')->middleware('guest');
Route::get('/moderator', [ModeratorSessionsController::class, 'create'])->name('m_login')->middleware('guest');
Route::post('/sessions', [UserSessionsController::class, 'store'])->middleware('guest');
Route::post('/moderator/sessions', [ModeratorSessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [UserSessionsController::class, 'destroy'])->middleware('auth:web');
Route::post('/moderator/logout', [ModeratorSessionsController::class, 'destroy'])->middleware('auth:web_moderator');
Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register')->middleware('guest');

