<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Page</title>
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
                            <img src="{{ asset('storage/images/users/'.$user->image) }}" alt="{{ $user->first_name }} image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4">
                            {{ $user->first_name." ".$user->last_name }}
                        </p>
                        <p class="subtitle is-small" id="address">
                            <span class="icon">
                                <i class="gg-user"></i>
                            </span>
                            <span>{{ $user->username }}</span>
                        </p>
                    </div>
                    <div class="buttons">
                        <a href="/profile/edit">
                            <button class="button is-medium is-primary" type="button" hidden>
                                Edit
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
</div>
</body>
</html>
