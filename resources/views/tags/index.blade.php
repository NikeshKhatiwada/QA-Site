<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tags Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="container">

    <div class="section">
        <h2 class="title is-2">Tags</h2>
        <hr>
        <div class="is-clearfix">
            <div class="field is-pulled-left">
                <a href="/tags/create">
                    <button class="button is-medium is-primary is-pulled-right">Add Tag</button>
                </a>
            </div>
            <div class="field has-addons is-pulled-right">
                <form id="show-tags" method="get" action="" hidden>
                    <input type="radio" title="suggested" id="suggested" name="tag_type" value="suggested" required>
                    <input type="radio" title="top" id="top" name="tag_type" value="top" required>
                    <input type="radio" title="new" id="new" name="tag_type" value="new" required>
                </form>
                <p class="control">
                    <button class="button is-medium">
                        <span>Suggested</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button is-medium" type="submit"
                            onclick="document.getElementById('top').setAttribute('checked', 'checked');document.getElementById('show-tags').submit();">
                        <span>Top Posted</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button is-medium" type="submit"
                            onclick="document.getElementById('new').setAttribute('checked', 'checked');document.getElementById('show-tags').submit();">
                        <span>Newly Posted</span>
                    </button>
                </p>
            </div>
        </div>
    </div>

    <div class="section box">
        <div class="tile is-ancestor">
            <div class="tile is-parent is-flex-wrap-wrap is-12">
                @foreach($tags as $tag)
                    <div class="tile is-4 has-fixed-size">
                        <div class="tile card ml-2 mr-2 mt-2 mb-2">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-128x128">
                                            <img src="{{ asset('/storage/images/tags/'.$tag->image) }}" alt="{{ $tag->title }} Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">
                                            <a href="/tag/{{ $tag->slug }}/show">{{ $tag->title }}</a>
                                        </p>
                                        <p class="subtitle is-6">{{ $tag->tagCategory->name }}</p>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="is-text">
                                        Total questions:
                                        {{ $tag->questions->count() }}
                                    </div>
                                    <div class="is-text">
                                        @if(!$tag->questions->isEmpty())
                                            Last question asked:
                                            <time>{{ $tag->questions()->latest()->first()->created_at->format('Y/m/d') }}</time>
                                        @endif
                                    </div>
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
