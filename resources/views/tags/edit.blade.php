<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tag Edit Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-tags-multiple').select2();
        });
    </script>
</head>
<body>
<x-navbar />
<div class="container">
    <h3 class="title is-3">Edit Tag</h3>

    <form method="post" enctype="multipart/form-data" action="/tag/{{ $tag->slug }}">
        @method('PATCH')
        @csrf
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input class="input" type="text" id="title" name="title" placeholder="Tag Title" value="{{ $tag->title }}" required>
            </div>
            @error('title')
            <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        {{--
        <div class="field">
            <label class="label" for="related-tags">Related Tags</label>
            <div class="is-multiple">
                <select class="input js-tags-multiple" id="related-tags" name="related-tags" size="6" multiple="multiple" required>
                    <option value="asp.net">ASP.NET</option>
                    <option value="crystal">Crystal</option>
                    <option value="html" selected>HTML</option>
                    <option value="java" selected>Java</option>
                </select>
            </div>
            @error('related-tags')
            <p class="help in-danger">{{ $message }}</p>
            @enderror
        </div>
        --}}

        <div class="field">
            <label class="label" for="image">Image</label>
            <div class="control">
                <div class="file has-name">
                    <label class="file-label">
                        <input class="file-input" type="file" id="image" name="image" placeholder="Enter an image"
                               onchange="document.getElementById('image-name').innerText = document.getElementById('image').files[0].name;">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="gg-file-add"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                        <span class="file-name" id="image-name">
                        </span>
                    </label>
                </div>
            </div>
            @error('image')
            <p class="help in-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>
            <div class="control">
                <textarea class="textarea" rows="10" id="description" name="description" placeholder="Tag Description" required>{{ $tag->description }}</textarea>
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
</body>
</html>
