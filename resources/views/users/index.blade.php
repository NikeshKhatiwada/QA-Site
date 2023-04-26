<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="container">

    <div class="section">
        <h2 class="title is-2">Users</h2>
        <hr>
        <div class="is-clearfix">
            <div class="field has-addons is-pulled-right">
                <p class="control">
                    <button class="button is-medium">
                        <span>Top</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button is-medium">
                        <span>New</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button is-medium">
                        <span>Old</span>
                    </button>
                </p>
            </div>
        </div>
    </div>

    <div class="section box">
        <div class="tile is-ancestor">
            <div class="tile is-parent is-flex-wrap-wrap is-12">
                @foreach($users as $user)
                    <div class="tile is-4 has-fixed-size">
                        <div class="tile card ml-2 mr-2 mt-2 mb-2">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-128x128">
                                            <img src="{{ asset('/storage/images/users/'.$user->image) }}" alt="{{ $user->first_name }} image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">
                                            <a href="/user/{{ $user->username }}/show">{{ $user->username }}</a>
                                        </p>
                                        <p class="subtitle is-6">{{ $user->district.", ".$user->country }}</p>
                                        <p class="is-text is-6">
                                            Joined:
                                            <time>{{ $user->created_at->format('Y/m/d') }}</time>
                                        </p>
                                        <p class="is-text is-6">
                                            Last seen:
                                            <time datetime="2021-3-6">2015/3/6</time>
                                        </p>
                                    </div>
                                </div>

                                <div class="content">
                                    {{--
                                    <div class="is-text is-bold">Score: {{ $user->score }}</div>
                                    --}}
                                    <div class="is-text is-bold">Followers: {{ $user->followerUsers->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
</html>
