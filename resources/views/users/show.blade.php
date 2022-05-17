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
                            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4">
                            Sujit Pradhan
                        </p>
                        <script>
                            if(document.getElementById('gender').innerText === "Male") {
                                document.getElementById('gender-female').setAttribute("hidden", "hidden");
                            }
                            else if(document.getElementById('gender').innerText === "Female") {
                                document.getElementById('gender-male').setAttribute("hidden", "hidden");
                            }
                        </script>
                        <p class="subtitle is-small" id="address">
                            <span class="icon">
                                <i class="gg-user"></i>
                            </span>
                            <span>SujitPradhan1234</span>
                        </p>
                    </div>
                    <div class="buttons">
                        <button class="button is-medium is-info">
                            Follow
                        </button>
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
                            <i class="gg-gender-male"></i>
                            <i class="gg-gender-female"></i>
                        </span>
                    <span>Male</span>
                </p>
                <p class="is-text is-small" id="address">
                        <span class="icon">
                            <i class="gg-home"></i>
                        </span>
                    <span>Birtamod-5, Buspark, Jhapa, Nepal</span>
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
                                <p class="title">2016</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Questions</p>
                                <p class="title">20</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Answers</p>
                                <p class="title">30</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Following</p>
                                <p class="title">123</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading">Followers</p>
                                <p class="title">24</p>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-content">
                <div class="content">
                    <div class="title is-5">Description</div>
                    <div class="is-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, delectus impedit incidunt inventore magnam porro qui quod recusandae unde voluptate? Animi at doloribus esse, exercitationem mollitia nobis nostrum numquam similique? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam autem consequuntur distinctio doloremque error iste magnam minus, nihil obcaecati odio placeat sed, veritatis? Assumenda nemo officia quae quasi quibusdam voluptatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aut nihil quis voluptates! Accusamus doloribus enim excepturi exercitationem illo ipsam itaque maxime, minus neque porro repudiandae soluta tempora vel vero.</p>
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
        @endfor
    </div>
</div>
</body>
</html>
