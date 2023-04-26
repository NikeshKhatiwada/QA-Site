<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="columns mt-1 mb-1 is-bordered">
    <div class="column is-fullheight ml-1 mr-1 is-8-tablet-only is-9">
        <div class="section box mt-4 mb-4">
            <div class="tags are-small">
                @foreach($question->tags as $tag)
                    <a class="tag" href="/tag/{{ $tag->slug }}/show">{{ $tag->title }}</a>
                @endforeach
            </div>
            @if($question->questionFollowers->where('id', auth('web')->id())->isEmpty())
                <form id="follow" method="post" action="/question/follow" hidden>
                    @csrf
                    <input type="text" class="input" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                </form>
            @elseif(!$question->questionFollowers->where('id', auth('web')->id())->isEmpty())
                <form id="unfollow" method="post" action="/question/unfollow" hidden>
                    @csrf
                    <input type="text" class="input" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                </form>
            @endif
            <h3 class="title is-3">
                {{ $question->title }}
                @if($question->questionFollowers->where('id', auth('web')->id())->isEmpty())
                    <button class="button is-medium is-info is-pulled-right" type="submit" onclick="document.getElementById('follow').submit()">
                        Follow
                    </button>
                @elseif(!$question->questionFollowers->where('id', auth('web')->id())->isEmpty())
                    <button class="button is-medium is-warning is-pulled-right" type="submit" onclick="document.getElementById('unfollow').submit()">
                        Unfollow
                    </button>
                @endif
            </h3>
            <article class="media">
                <div class="media-content">
                    <div class="columns">
                        <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                            <figure class="image is-64x64">
                                <img src="{{ asset('storage/images/users/'.$question->user->image) }}" alt="{{ $question->user->first_name }} image">
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

                    <div class="level is-mobile">
                        <div class="level-left">

                            @if(!($question->user->id === auth('web')->id()))
                                <form id="upvote" method="post" action="/question/upvote" hidden>
                                    @csrf
                                    <input type="text" class="input" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                </form>
                                <form id="downvote" method="post" action="/question/downvote" hidden>
                                    @csrf
                                    <input type="text" class="input" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                </form>
                                <div class="level-item">
                                    <button class="button is-light {{ $question->vote===1?'is-info':'' }}" type="submit" onclick="document.getElementById('upvote').submit()">
                                        <i class="gg-chevron-up"></i>
                                        {{ $question->upvotes }}
                                    </button>
                                </div>
                                <div class="level-item">
                                    <button class="button is-light {{ $question->vote===-1?'is-info':'' }}" type="submit" onclick="document.getElementById('downvote').submit()">
                                        <i class="gg-chevron-down"></i>
                                        {{ $question->downvotes }}
                                    </button>
                                </div>
                            @elseif($question->user->id === auth('web')->id())
                                <div class="level-item">
                                    <a href="/question/{{ $question->slug }}/edit">
                                        <button class="button is-primary" type="button">
                                            <i class="gg-pen"></i>
                                            Edit
                                        </button>
                                    </a>
                                </div>
                            @endif
                        </div>

                        @if(!($question->user->id === auth('web')->id()))
                            <div class="level-right">
                                <div class="level-item">
                                    <a href="/reports/create?itemCategory=question&itemId={{ $question->id }}">
                                        <button class="button is-danger" type="button">
                                            <i class="gg-flag"></i>
                                            Report
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{--
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-48x48">
                                <img src="{{ asset('storage/images/users/'.auth('web')->user()->image) }}" alt="{{ auth('web')->user()->username }} image">
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
                    --}}

                </div>
            </article>

        </div>

        <div class="box mt-4 mb-4">
            <h3 class="title is-4">Answers</h3>
        </div>

        <div class="box mt-4 mb-4 {{ !is_null($question->answer)?'is-hidden':'' }}" id="answer-form">
            <form method="post" action="{{ is_null($question->answer)?'/answers/'.$question->slug:'/answer/'.$question->slug }}">
                @csrf
                <input type="hidden" name="_method" value="{{ is_null($question->answer)?'POST':'PATCH' }}">
                <div class="field">
                    <label class="label" for="answer-description">
                        {{ is_null($question->answer)?'Add Answer':'Edit Answer' }}
                    </label>
                    <div class="control">
                        <textarea class="textarea" rows="10" id="answer-description" name="answer-description"
                                  required>{{ !is_null($question->answer)?$question->answer->description:old('answer-description') }}</textarea>
                    </div>
                    @error('answer-description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        @foreach($question->answers as $answer)
            <div class="section box mt-4 mb-4">
                <article class="media">
                    <div class="media-content">
                        <div class="columns">
                            <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                                <figure class="image is-64x64">
                                    <img src="{{ asset('storage/images/users/'.$answer->user->image) }}" alt="{{ $answer->user->first_name }} image">
                                </figure>
                            </div>
                            <div class="column">
                                <div class="is-bold">
                                    <a href="/user/{{ $answer->user->username }}/show">
                                        <strong>
                                            {{ $answer->user->first_name." ".$answer->user->last_name }}
                                        </strong>
                                    </a>
                                </div>
                                <div>Answered {{ $answer->user->created_at->format('Y/m/d') }}</div>
                            </div>
                        </div>

                        <div class="content">
                            {{ $answer->description }}
                        </div>
                        <div class="level is-mobile">
                            <div class="level-left">
                                @if(!($answer->user->id === auth('web')->id()))
                                    <div class="level-item">
                                        <form method="post" action="/answer/upvote">
                                            @csrf
                                            <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $answer->user->username }}" required>
                                            <input type="text" class="input is-hidden" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                            <button class="button is-light {{ $answer->vote===1?'is-info':'' }}" type="submit">
                                                <i class="gg-chevron-up"></i>
                                                {{ $answer->upvotes }}
                                            </button>
                                        </form>
                                    </div>
                                    <div class="level-item">
                                        <form method="post" action="/answer/downvote">
                                            @csrf
                                            <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $answer->user->username }}" required>
                                            <input type="text" class="input is-hidden" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                            <button class="button is-light {{ $answer->vote===-1?'is-info':'' }}" type="submit">
                                                <i class="gg-chevron-down"></i>
                                                {{ $answer->downvotes }}
                                            </button>
                                        </form>
                                    </div>
                                @elseif($answer->user->id === auth('web')->id())
                                    <div class="level-item">
                                        <button class="button is-primary" type="button" onclick="document.getElementById('answer-form').classList.remove('is-hidden')">
                                            <i class="gg-pen"></i>
                                            Edit
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="level-right">
                                @if(!($answer->user->id === auth('web')->id()))
                                    <div class="level-item">
                                        <a href="/reports/create?itemCategory=answer&itemId={{ $answer->id }}">
                                            <button class="button is-danger" type="button">
                                                <i class="gg-flag"></i>
                                                Report
                                            </button>
                                        </a>
                                    </div>
                                @elseif($answer->user->id === auth('web')->id())
                                    <div class="level-item">
                                        <form method="post" action="/answer/{{ $question->slug }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button is-danger">
                                                <i class="gg-close-o"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <article class="media is-hidden" id="comment-edit">
                            <figure class="media-left">
                                <p class="image is-48x48">
                                    <img src="{{ asset('storage/images/users/'.auth('web')->user()->image) }}" alt="{{ auth('web')->user()->username }} image">
                                </p>
                            </figure>
                            <div class="media-content">
                                <form method="post" id="comment-edit-form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="field">
                                        <p class="control">
                                            <input type="text" class="input" title="comment-edit-description" id="comment-edit-description" name="comment-edit-description" placeholder="Edit your comment" required>
                                        </p>
                                    </div>
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button type="submit" class="button is-link is-small">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" id="like" action="/comment/like" hidden>
                                    @csrf
                                    <input type="text" class="input" title="comment_id" id="like_comment_id" name="comment_id" required>
                                </form>
                                <form method="post" id="delete-comment" hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </article>

                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-48x48">
                                    <img src="{{ asset('storage/images/users/'.auth('web')->user()->image) }}" alt="{{ auth('web')->user()->username }} image">
                                </p>
                            </figure>
                            <div class="media-content">
                                <form method="post" action="/comments">
                                    @csrf
                                    <div class="field">
                                        <p class="control">
                                            <input type="text" class="input is-hidden" title="user_username" id="user_username" name="user_username" value="{{ $answer->user->username }}" required>
                                            <input type="text" class="input is-hidden" title="question_slug" id="question_slug" name="question_slug" value="{{ $question->slug }}" required>
                                            <input type="text" class="input" title="comment-description" id="comment-description" name="comment-description" placeholder="Write a comment" required>

                                        </p>
                                    </div>
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button type="submit" class="button is-link is-small">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </article>

                        @foreach($answer->comments as $comment)
                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-48x48">
                                        <img src="{{ asset('storage/images/users/'.$comment->user->image) }}" alt="{{ $comment->user->first_name }} image">
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
                                                @if(!($comment->user->id === auth('web')->id()))
                                                    <a onclick="document.getElementById('like_comment_id').value='{{ $comment->id }}';document.getElementById('like').submit()">
                                                        {{ $comment->commentLikes()->where('user_id', auth('web')->id())->exists()?'Unlike':'Like' }}
                                                    </a>
                                                @endif
                                                {{ $comment->commentLikes()->count() }} likes
                                            </small> .
                                            @if($comment->user->id === auth('web')->id())
                                                <small>
                                                    <a class="has-text-primary" onclick="document.getElementById('comment-edit-form').action='/comment/{{ $comment->id }}';document.getElementById('comment-edit-description').value='{{ $comment->description }}';document.getElementById('comment-edit').classList.remove('is-hidden')">
                                                        Edit
                                                    </a>
                                                </small> .
                                            @endif
                                            <small>
                                                @if(!($comment->user->id === auth('web')->id()))
                                                    <a class="has-text-danger" href="/reports/create?itemCategory=comment&itemId={{ $comment->id }}">Report</a>
                                                @elseif($comment->user->id === auth('web')->id())
                                                    <a class="has-text-danger" onclick="document.getElementById('delete-comment').action='/comment/{{ $comment->id }}';document.getElementById('delete-comment').submit()">Delete</a>
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </article>

            </div>
        @endforeach
    </div>

    <div class="column ml-1 mr-1 is-fullheight is-4-tablet-only is-3">
        <div class="content is-medium" style="overflow: auto">
            <h5 class="title is-5">Related Questions</h5>
            <ul class="ml-0" style="list-style: none">
                @foreach($related_questions as $related_question)
                    <li class="mt-2 mb-2">
                        <a href="/question/{{ $related_question->slug }}/show">
                            <span>{{ $related_question->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            {{--
            <span>
                <a href="/">
                    <button type="button" class="button is-light is-large">All Questions</button>
                </a>
            </span>
            --}}
        </div>
    </div>
</div>
</body>
</html>
