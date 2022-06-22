<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Create Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half box mt-6 mb-6">
            <h3 class="title is-3">Report {{ $reportAbout->category }}</h3>

            <form method="post" action="/reports">
                @csrf
                <input type="text" class="input is-hidden" title="reported-item-category" id="reported-item-category" name="reported-item-id" value="{{ $reportAbout->category }}">
                <input type="number" class="input is-hidden" title="reported-item-id" id="reported-item-id" name="reported-item-id" value="{{ $reportAbout->name }}">
                <div class="field">
                    <label class="label" for="title">{{ $reportAbout->category }} {{ $reportAbout->category==="User"?"Name":"Title/Description" }}</label>
                    <div class="control">
                        <textarea class="textarea" rows="4" id="title" name="title" placeholder="{{ $reportAbout->category }} {{ $reportAbout->category==="Question"?"Title":"Description" }}" readonly required>{{ $reportAbout->title }}</textarea>
                    </div>
                    @error('title')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="category">Report Category</label>
                    <div class="select">
                        <select id="category" name="category" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ in_array($category->name, old('categories')?:[])?'selected':'' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="description">Report Description</label>
                    <div class="control">
                        <textarea class="textarea" rows="6" id="description" name="description" placeholder="Report Description" value="{{ old('description') }}" required></textarea>
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
    </div>
</div>
</body>
</html>
