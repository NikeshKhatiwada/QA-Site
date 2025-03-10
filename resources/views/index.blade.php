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
    <div class="is-clearfix mt-4 mb-4">
        <a href="/questions/create">
            <button class="button is-medium is-primary is-pulled-right">Ask New Question</button>
        </a>
    </div>
    <hr>
    <div class="is-clearfix">
        <div class="field has-addons is-pulled-right">
            <form id="show-questions" method="get" action="" hidden>
                <input type="radio" title="suggested" id="suggested" name="question_type" value="suggested" required>
                <input type="radio" title="following" id="following" name="question_type" value="following" required>
                <input type="radio" title="top" id="top" name="question_type" value="top" required>
                <input type="radio" title="new" id="new" name="question_type" value="new" required>
            </form>
            <p class="control">
                <button class="button is-medium" type="submit"
                        onclick="document.getElementById('suggested').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                    <span>Suggested</span>
                </button>
            </p>
            <p class="control">
                <button class="button is-medium" type="submit"
                        onclick="document.getElementById('following').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                    <span>Following</span>
                </button>
            </p>
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
    @if($questions->isEmpty())
        <div class="section box mt-4 mb-4">
            <p class="is-text">No Questions available to display.</p>
        </div>
    @else
        @foreach($questions as $question)
            <div class="section box mt-4 mb-4">
                <h6 class="title is-6">
                    <a href="/question/{{ $question->slug }}/show">
                        {{ $question->title }}
                    </a>
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
                                    <div>Answered {{ $question->top_answer->created_at->format('Y/m/d') }}</div>
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
                            --}}

                            @foreach($question->top_answer->comments as $comment)
                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-48x48">
                                            <img src="{{ asset('/storage/images/users/'.$comment->user->image) }}" alt="{{ $comment->user->first_name }} image">
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
                                                {{--
                                                <small>{{ $comment->created_at->format('Y/m/d') }}</small> .
                                                <small>
                                                    <a>
                                                        {{ $comment->commentLikes()->where('user_id', auth('web')->id())->exists()?'Unlike':'Like' }}
                                                    </a>
                                                    {{ $comment->commentLikes()->count() }} </small> .
                                                <small>
                                                    <a class="has-text-danger">Report</a>
                                                </small>
                                                --}}
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
    @endif
</div>
{{--
<div class="columns mt-1 mb-1 is-bordered">
    <div class="column ml-3 is-fullheight is-3-tablet-only is-2 is-hidden-mobile">
        <div class="content is-medium" style="overflow: hidden">
            <h5 class="title is-5">Popular Tags</h5>
                <ul class="ml-0" style="list-style: none">
                    @for($i = 0; $i <24; $i ++)
                        <li class="mt-2 mb-2">
                            <a href="/">
                                <span class="icon-text">
                                    <span class="icon">
                                        <img class="is-square" src="https://bulma.io/images/placeholders/128x128.png" alt="Image" />
                                    </span>
                                    <span>
                                        Hello World
                                    </span>
                                </span>
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
    <div class="column is-fullheight ml-1 mr-1 is-6-tablet-only is-8">
        <div class="is-clearfix">
            <button class="button is-medium is-primary is-pulled-right js-modal-trigger">Ask New Question</button>
        </div>
        <div class="modal" id="question-form-model">
            <div class="modal-background"></div>
            <div class="modal-card">
                <form method="post" id="#question-form" action="/questions/create"></form>
            </div>
        </div>
        <hr>
        <div class="is-clearfix">
            <div class="field has-addons is-pulled-right">
                <p class="control">
                    <button class="button is-medium">
                        <span>Suggested</span>
                    </button>
                </p>
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
            </div>
        </div>
        @for($i = 0; $i < 12; $i++)
            <div class="section box mt-4 mb-4">
                <h6 class="title is-6">How to embed images using javascript?</h6>
                <article class="media">
                    <div class="media-content">
                        <div class="columns">
                            <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                                <figure class="image is-64x64">
                                    <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                                </figure>
                            </div>
                            <div class="column">
                                <div class="is-bold">Sujit Pradhan</div>
                                <div>Answered 2 days ago</div>
                            </div>
                        </div>

                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias asperiores fugit illum minima nesciunt quos. Amet architecto cupiditate eaque eligendi eveniet ipsum, iusto nemo nostrum odio perspiciatis, reprehenderit saepe! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, quas, repellendus. Animi asperiores consequuntur debitis dolores earum exercitationem iste minima nulla officia officiis pariatur praesentium repellendus saepe sit veniam, voluptatibus.
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
                                    <button class="button is-light" type="submit" onclick="document.getElementById('upvote').submit()">
                                        <i class="gg-chevron-up"></i>
                                        711
                                    </button>
                                </div>
                                <div class="level-item">
                                    <button class="button is-light" type="submit" onclick="document.getElementById('downvote').submit()">
                                        <i class="gg-chevron-down"></i>
                                        28
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
                                    <img src="https://bulma.io/images/placeholders/128x128.png">
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

                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-48x48">
                                    <img src="https://bulma.io/images/placeholders/96x96.png">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>Kayli Eunice </strong>
                                        <br>
                                        Sed convallis scelerisque mauris, non pulvinar nunc mattis vel. Maecenas varius felis sit amet magna vestibulum euismod malesuada cursus libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus lacinia non nisl id feugiat.
                                        <br>
                                        <small>2 hrs</small> .
                                        <small><a>Like</a> 24 </small> .
                                        <small><a class="has-text-danger">Report</a></small>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </article>

            </div>
        @endfor
    </div>

    <div class="column mr-3 is-fullheight is-3-tablet-only is-2 is-hidden-mobile">
        <div class="content is-medium" style="overflow: hidden">
            <h5 class="title is-5">Popular Users</h5>
            <ul class="ml-0" style="list-style: none">
                @for($i = 0; $i <24; $i ++)
                    <li class="mt-2 mb-2">
                        <a href="/">
                            <span class="icon-text">
                                <span class="icon">
                                    <img class="is-square" src="https://bulma.io/images/placeholders/128x128.png" alt="Image" />
                                </span>
                                <span>
                                    Hello World
                                </span>
                            </span>
                        </a>
                    </li>
                @endfor
            </ul>
            <span>
                <a href="">
                    <button type="button" class="button is-light is-large">All Users</button>
                </a>
            </span>
        </div>
    </div>
</div>
--}}
</body>
</html>
