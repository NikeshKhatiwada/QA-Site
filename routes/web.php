<?php

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

Route::get('/', function () {
    return view('index');
});//->middleware('auth:web');

Route::get('/home', function () {
    return view('index');
});//->middleware('auth:web');

Route::get('/question/show', function () {
    return view('questions.show');
});

Route::get('/question/create', function () {
    return view('questions.create');
}); //->middleware('user');

Route::get('/question/edit', function () {
    return view('questions.edit');
}); //->middleware('user');

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tag/show/{tag}', [TagController::class, 'show']);
Route::get('/tag/create', [TagController::class, 'create']);
Route::get('/tag/edit', [TagController::class, 'edit']);

Route::get('/users', function () {
    return view('users.index');
});

Route::get('/login', [UserSessionsController::class, 'create'])->name('login')->middleware('guest');
