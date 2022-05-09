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
                <button class="button is-medium is-primary is-pulled-right js-modal-trigger">Add Tag</button>
            </div>
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
    </div>

    <div class="section box">
        <div class="tile is-ancestor">
            <div class="tile is-parent is-flex-wrap-wrap is-12">
                @for($i = 0; $i < 18; $i++)
                    <div class="tile is-4 has-fixed-size">
                        <div class="tile card ml-2 mr-2 mt-2 mb-2">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-128x128">
                                            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <p class="title is-4">
                                            <a href="/tag/css">CSS</a>
                                        </p>
                                        <p class="subtitle is-6">Language</p>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="is-text">Total questions: 187</div>
                                    <div class="is-text">
                                        Last question asked:
                                        <time datetime="2022-1-1">Jan 1, 2022</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
</body>
</html>
