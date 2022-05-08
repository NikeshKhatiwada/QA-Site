<?php

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
});

Route::get('/question/', function () {
    return view('questions.show');
});

Route::get('/questions/create', function () {
    return view('questions.create');
}); //->middleware('user');

Route::get('/tags', function () {
    return view('tags.index');
});

Route::get('/login', function() {
    return view('sessions.create');
})->middleware('guest');
