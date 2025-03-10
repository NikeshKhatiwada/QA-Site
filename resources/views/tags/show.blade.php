<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tag Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="columns mt-1 mb-1 is-bordered">
    <div class="column is-fullheight ml-1 mr-1 is-9-tablet-only is-10">
        <div class="tile is-12 has-fixed-size">
            <div class="tile card">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-128x128">
                                <img src="{{ asset('/storage/images/tags/'.$tag->image) }}" alt="{{ $tag->title }} image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">
                                {{ $tag->title }}
                            </p>
                            <p class="subtitle is-6">{{ $tag->tagCategory->name }}</p>
                            <p class="is-text">Total Questions: {{ $tag->questions->count() }}</p>
                            <div class="is-text">
                                @if(!$tag->questions->isEmpty())
                                    Last question asked:
                                    <time>{{ $tag->questions()->latest()->first()->created_at->format('Y/m/d') }}</time>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="title is-5">Description</div>
                        <div class="is-text">
                            <p>{{ $tag->description }}</p>
                        </div>
                    </div>

                    <div class="buttons">
                        @if($tag->tagFollowers->where('id', auth('web')->id())->isEmpty())
                            <form id="follow" method="post" action="/tag/follow">
                                @csrf
                                <input type="text" class="input is-hidden" title="tag_slug" id="tag_slug" name="tag_slug" value="{{ $tag->slug }}" required>
                                <button class="button is-medium is-info" type="submit">Follow</button>
                            </form>
                        @elseif(!$tag->tagFollowers->where('id', auth('web')->id())->isEmpty())
                            <form id="unfollow" method="post" action="/tag/unfollow">
                                @csrf
                                <input type="text" class="input is-hidden" title="tag_slug" id="tag_slug" name="tag_slug" value="{{ $tag->slug }}" required>
                                <button class="button is-medium is-warning" type="submit">Unfollow</button>
                            </form>
                        @endif
                        <a href="/tags/{{ $tag->slug }}/edit">
                            <button class="button is-medium is-primary" type="button">
                                Edit
                            </button>
                        </a>
                        <a href="/reports/create?itemCategory=tag&itemId={{ $tag->id }}">
                            <button class="button is-medium is-danger" type="button">
                                <i class="gg-flag"></i>
                                Report
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="is-clearfix">
            <div class="field has-addons is-pulled-right">
                <form id="show-questions" method="get" action="" hidden>
                    <input type="radio" title="top" id="top" name="question_type" value="top" required>
                    <input type="radio" title="new" id="new" name="question_type" value="new" required>
                </form>
                <p class="control">
                    <button class="button is-medium" type="submit"
                            onclick="document.getElementById('top').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                        <span>Top</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button is-medium" type="submit"
                            onclick="document.getElementById('new').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                        <span>New</span>
                    </button>
                </p>
            </div>
        </div>
        @foreach($questions as $question)
            <div class="section box mt-4 mb-4">
                <h6 class="title is-6">
                    <a href="/question/{{ $question->slug }}/show">{{ $question->title }}</a>
                </h6>
                @if(!$question->answers->isEmpty())
                    <article class="media">
                        <div class="media-content">
                            <div class="columns">
                                <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                                    <figure class="image is-64x64">
                                        <img src="{{ asset('/storage/images/users/'.$question->top_answer->user->image) }}" alt="{{ $question->top_answer->user->first_name }} image">
                                    </figure>
                                </div>
                                <div class="column">
                                    <div class="is-bold">
                                        <a href="/user/{{ $question->top_answer->user->username }}/show">
                                            <strong>
                                                {{ $question->top_answer->user->first_name." ".$question->top_answer->user->last_name }}
                                            </strong>
                                        </a>
                                    </div>
                                    <div>Answered {{ $question->top_answer->user->created_at->format('Y/m/d') }}</div>
                                </div>
                            </div>

                            <div class="content">
                                {{ $question->top_answer->description }}
                            </div>

                            @if(!($question->top_answer->user->id === auth('web')->id()))
                                <div class="level is-mobile">
                                    <div class="level-left">
                                        <div class="level-item">
                                            <form id="upvote" method="post" action="/answer/upvote">
                                                @csrf
                                                <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $question->top_answer->user->username }}" required>
                                                <input type="text" class="input is-hidden" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                                <button class="button is-light {{ $question->top_answer->vote===1?'is-info':'' }}" type="submit">
                                                    <i class="gg-chevron-up"></i>
                                                    {{ $question->top_answer->upvotes }}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="level-item">
                                            <form id="downvote" method="post" action="/answer/downvote">
                                                @csrf
                                                <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $question->top_answer->user->username }}" required>
                                                <input type="text" class="input is-hidden" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                                <button class="button is-light {{ $question->top_answer->vote===-1?'is-info':'' }}" type="submit">
                                                    <i class="gg-chevron-down"></i>
                                                    {{ $question->top_answer->downvotes }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="level-right">
                                        <div class="level-item">
                                            <a href="/reports/create?itemCategory=answer&itemId={{ $question->top_answer->id }}">
                                                <button class="button is-danger" type="button">
                                                    <i class="gg-flag"></i>
                                                    Report
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{--
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

                            @foreach($question->top_answer->comments as $comment)
                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-48x48">
                                            <img src="{{ asset('/storage/app/public/images/users/'.$comment->user->image) }}" alt="{{ $comment->user->first_name }} image">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <a href="/user/{{ $comment->user->username }}/show">
                                                    <strong>
                                                        {{ $comment->user->first_name." ".$comment->user->last_name }}
                                                    </strong>
                                                </a>
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
                            --}}
                        </div>
                    </article>
                @endif
            </div>
        @endforeach
    </div>

    {{--
    <div class="column mr-3 is-fullheight is-3-tablet-only is-2">
        <div class="content is-medium" style="overflow: hidden">
            <h5 class="title is-5">Related Tags</h5>
            <ul class="ml-0" style="list-style: none">
                @for($i = 0; $i <24; $i ++)
                    <li class="mt-2 mb-2">
                        <a href="/">
                            <span>Java</span>
                        </a>
                    </li>
                @endfor
            </ul>
            <span>
                <a href="">
                    <button type="button" class="button is-light is-large">All Tags</button>
                </a>
            </span>
        </div>
    </div>
    --}}
</div>
</body>
</html>
