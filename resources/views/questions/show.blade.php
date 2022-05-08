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
                <a class="tag">JavaScript</a>
                <a class="tag">NodeJs</a>
            </div>
            <form id="follow" method="post" action="/follow" hidden>
                <input type="text" class="input" title="questionId" id="questionId" name="questionId" value="Question" required>
            </form>
            <h3 class="title is-3">
                How to embed images using javascript in NodeJs?
                <button class="button is-info is-pulled-right" type="submit" onclick="document.getElementById('follow').submit()">
                    Follow
                </button>
            </h3>
            <article class="media">
                <div class="media-content">
                    <div class="columns">
                        <div class="column is-2-tablet is-1-widescreen has-fixed-size">
                            <figure class="image is-64x64">
                                <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                            </figure>
                        </div>
                        <div class="column">
                            <div class="is-bold">Manish Subedi</div>
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

        <div class="box mt-4 mb-4">
            <h3 class="title is-4">Answers</h3>
        </div>

        @for($i = 0; $i < 12; $i++)
            <div class="section box mt-4 mb-4">
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

    <div class="column mr-3 is-fullheight is-4-tablet-only is-3">
        <div class="content is-medium" style="overflow: hidden">
            <h5 class="title is-5">Related Questions</h5>
            <ul class="ml-0" style="list-style: none">
                @for($i = 0; $i <24; $i ++)
                    <li class="mt-2 mb-2">
                        <a href="/">
                            <span>How to connect to NodeJs with C#?</span>
                        </a>
                    </li>
                @endfor
            </ul>
            <span>
                <a href="">
                    <button type="button" class="button is-light is-large">All Questions</button>
                </a>
            </span>
        </div>
    </div>
</div>
</body>
</html>
