<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question Edit Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <h3 class="title is-3">Edit Question</h3>

    <form method="post" action="/question/{{ $question->slug }}">
        @csrf
        @method('PATCH')
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input class="input" type="text" id="title" name="title" placeholder="Question Title" value="{{ $question->title }}" required>
            </div>
            @error('title')
            <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="tags">Tags</label>
            <div class="is-multiple">
                <select class="input js-tags-multiple" id="tags" name="tags[]" size="6" multiple="multiple" required>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->slug }}" {{ in_array($tag->slug, $question_tags?:[])?'selected':'' }}>
                            {{ $tag->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('tags')
            <p class="help in-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>
            <div class="control">
                <textarea class="textarea" rows="10" id="description" name="description" placeholder="Question Description" required>{{ $question->description }}</textarea>
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

            <div class="control">
                <button type="button" class="button is-danger" name="delete" onclick="document.getElementById('delete-question').submit()">Delete</button>
            </div>
        </div>

    </form>

    <form method="post" id="delete-question" action="/question/{{ $question->slug }}">
        @csrf
        @method('DELETE')
    </form>
</div>
</body>
</html>
