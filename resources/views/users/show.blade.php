<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="container">
    <div class="section">
        <div class="card mb-2">
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-128x128">
                            <img src="{{ asset('/storage/app/public/images/users/'.$user->image) }}" alt="{{ $user->first_name }} image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4">
                            {{ $user->first_name." ".$user->last_name }}
                        </p>
                        <script>
                        </script>
                        <p class="subtitle is-small" id="address">
                            <span class="icon">
                                <i class="gg-user"></i>
                            </span>
                            <span>{{ $user->username }}</span>
                        </p>
                    </div>
                    <div class="buttons">
                        @if($user->followerUsers->where('id', auth('web')->id())->isEmpty())
                            <form id="follow" method="post" action="/user/follow">
                                @csrf
                                <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $user->username }}" required>
                                <button class="button is-medium is-info" type="submit">Follow</button>
                            </form>
                        @elseif(!$user->followerUsers->where('id', auth('web')->id())->isEmpty())
                            <form id="unfollow" method="post" action="/user/unfollow">
                                @csrf
                                <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $user->username }}" required>
                                <button class="button is-medium is-warning" type="submit">Unfollow</button>
                            </form>
                        @endif
                        <a href="">
                            <button class="button is-medium is-danger" type="button">
                                <i class="gg-flag"></i>
                                Report
                            </button>
                        </a>
                    </div>

                </div>
                <p class="is-text is-small" id="gender">
                        <span class="icon">
                            <i class="{{ $user->gender===0?'gg-gender-male':'gg-gender-female' }}"></i>
                        </span>
                    <span>{{ $user->gender===0?'Male':'Female' }}</span>
                </p>
                <p class="is-text is-small" id="address">
                        <span class="icon">
                            <i class="gg-home"></i>
                        </span>
                    <span>{{ $user->address.", ".$user->district.", ".$user->country }}</span>
                </p>
            </div>
        </div>

        <div class="card mt-2 mb-2">
            <div class="card-content">
                <div class="content">
                    <nav class="level">
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Score</p>
                                <p class="title">{{ $user->score }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Questions</p>
                                <p class="title">{{ $user->questions->count() }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Answers</p>
                                <p class="title">{{ $user->answers->count() }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Following</p>
                                <p class="title">{{ $user->followingUsers()->count() }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Followers</p>
                                <p class="title">{{ $user->followerUsers()->count() }}</p>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-content">
                <div class="content">
                    <div class="title is-5">About</div>
                    <div class="is-text">
                        <p>{{ $user->about }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="is-clearfix">
        <div class="field has-addons is-pulled-right">
            <form id="show-QA" method="get" action="" hidden>
                <input type="radio" title="questions" id="questions" name="qORa" value="questions" required>
                <input type="radio" title="answers" id="answers" name="qORa" value="answers" required>
            </form>
            <p class="control">
                <button class="button is-medium" type="submit"
                        onclick="document.getElementById('questions').setAttribute('checked', 'checked');document.getElementById('show-QA').submit();">
                    <span>Questions</span>
                </button>
            </p>
            <p class="control">
                <button class="button is-medium" type="submit"
                        onclick="document.getElementById('answers').setAttribute('checked', 'checked');document.getElementById('show-QA').submit();">
                    <span>Answers</span>
                </button>
            </p>
        </div>
    </div>
    @isset($questions)
        @foreach($questions as $question)
            <div class="section box mt-4 mb-4">
                <h6 class="title is-6">
                    <a href="/question/{{ $question->slug }}/show">{{ $question->title }}</a>
                </h6>
                @if(!is_null($question->answer))
                    <article class="media">
                        <div class="media-content">
                            <div class="columns">
                                <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                                    <figure class="image is-64x64">
                                        <img src="{{ asset('/storage/app/public/images/users/'.$question->answer->user->image) }}" alt="{{ $question->answer->user->first_name }} image">
                                    </figure>
                                </div>
                                <div class="column">
                                    <div class="is-bold">
                                        <a href="/user/{{ $question->answer->user->username }}/show">
                                            <strong>
                                                {{ $question->answer->user->first_name." ".$question->answer->user->last_name }}
                                            </strong>
                                        </a>
                                    </div>
                                    <div>Answered {{ $question->answer->user->created_at->format('Y/m/d') }}</div>
                                </div>
                            </div>

                            <div class="content">
                                {{ $question->answer->description }}
                            </div>
                            <div class="level is-mobile">
                                <div class="level-left">
                                    <form id="upvote" method="post" action="/upvote" hidden>
                                        <input type="text" class="input" title="questionId" id="questionId" name="questionId" value="Question" required>
                                        <input type="text" class="input" title="answerId" id="answerId" name="answerId" value="Answer" required>
                                    </form>
                                    <form id="downvote" method="post" action="/downvote" hidden>
                                        <input type="text" class="input" title="questionId" id="questionId" name="questionId" value="Question" required>
                                        <input type="text" class="input" title="answerId" id="answerId" name="answerId" value="Answer" required>
                                    </form>
                                    <div class="level-item">
                                        <button class="button is-light {{ $question->answer->vote===1?'is-info':'' }}" type="submit" onclick="document.getElementById('upvote').submit()">
                                            <i class="gg-chevron-up"></i>
                                            {{ $question->answer->upvotes }}
                                        </button>
                                    </div>
                                    <div class="level-item">
                                        <button class="button is-light {{ $question->answer->vote===-1?'is-info':'' }}" type="submit" onclick="document.getElementById('downvote').submit()">
                                            <i class="gg-chevron-down"></i>
                                            {{ $question->answer->downvotes }}
                                        </button>
                                    </div>
                                </div>
                                <div class="level-right">
                                    <div class="level-item">
                                        <a href="">
                                            <button class="button is-danger" type="button">
                                                <i class="gg-flag"></i>
                                                Report
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-48x48">
                                        <img src="{{ asset('/storage/app/public/images/users/'.auth('web')->user()->image) }}" alt="{{ auth('web')->user()->username }} image">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="field">
                                        <form method="post" action="">
                                            <p class="control">
                                                <input type="text" class="input" title="comment" id="comment" name="comment" placeholder="Write a comment" required>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </article>

                            @foreach($question->answer->comments as $comment)
                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-48x48">
                                            <img src="{{ asset('/storage/app/public/images/users/'.$comment->user->image) }}" alt="{{ $comment->user->first_name }} image">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>
                                                    <a href="/user/{{ $comment->user->username }}/show">
                                                        <strong>
                                                            {{ $comment->user->first_name." ".$comment->user->last_name }}
                                                        </strong>
                                                    </a>
                                                </strong>
                                                <br>
                                                {{ $comment->description }}
                                                <br>
                                                <small>{{ $comment->created_at->format('Y/m/d') }}</small> .
                                                <small>
                                                    <a>
                                                        {{ $comment->commentLikes()->where('user_id', auth('web')->id())->exists()?'Unlike':'Like' }}
                                                    </a>
                                                    {{ $comment->commentLikes()->count() }} </small> .
                                                <small>
                                                    <a class="has-text-danger">Report</a>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </article>
                @endif
                </div>
        @endforeach
    @endisset
</div>
</body>
</html>
