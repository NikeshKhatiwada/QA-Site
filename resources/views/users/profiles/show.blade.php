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
                        <a href="">
                            <button class="button is-medium is-primary" type="button" hidden>
                                Edit
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
</div>
</body>
</html>
