<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="container">
    <h3 class="title is-3">Search Questions</h3>
    <div class="is-clearfix mt-4 mb-4">
        <form method="get" action="">
            <div class="field">
                <div class="control">
                    <input class="input" type="text" name="search_query" title="search_query" placeholder="Search Box">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-info">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <hr>
    @if(!$questions->isEmpty())
        @foreach($questions as $question)
            <div class="section box mt-4 mb-4">
                <h6 class="title is-6">
                    <a href="/question/{{ $question->slug }}/show">
                        {{ $question->title }}
                    </a>
                </h6>
                <article class="media">
                    <div class="media-content">
                        <div class="columns">
                            <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                                <figure class="image is-64x64">
                                    <img src="{{ asset('/storage/images/users/'.$question->user->image) }}" alt="{{ $question->user->first_name }} image">
                                </figure>
                            </div>
                            <div class="column">
                                <div class="is-bold">
                                    <a href="/user/{{ $question->user->username }}/show">
                                        <strong>
                                            {{ $question->user->first_name." ".$question->user->last_name }}
                                        </strong>
                                    </a>
                                </div>
                                <div>Questioned {{ $question->created_at->format('Y/m/d') }}</div>
                            </div>
                        </div>

                        <div class="content">
                            {{ $question->description }}
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    @endif
</div>
</body>
</html>
