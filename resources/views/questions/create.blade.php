<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="columns is-8 mt-1 mb-1 is-bordered">
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
    <div class="column is-fullheight ml-1 mr-1 mt-1 mb-1 is-6-tablet-only is-8">
        <h3 class="title is-3">Ask Question</h3>

        <form method="post" action="">
            @csrf
            <div class="field">
                <label class="label" for="title">Title</label>
                <div class="control">
                    <input class="input" type="text" id="title" name="title" placeholder="Question Title" required>
                </div>
                @error('title')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label" for="description">Description</label>
                <div class="control">
                    <textarea class="textarea" rows="20" id="description" name="description" placeholder="Question Description" required></textarea>
                </div>
                @error('description')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary" name="submit">Submit</button>
                </div>

                <div class="control">
                    <button type="reset" class="button is-warning" name="reset">Reset</button>
                </div>
            </div>

        </form>
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
</body>
</html>
