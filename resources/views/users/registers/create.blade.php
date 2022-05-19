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
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half box mt-6 mb-6">
            <h3 class="title is-3">Login Page</h3>
            <form method="post" action="/sessions">
                @csrf
                <div class="field">
                    <label class="label" for="first-name">First Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="first-name" name="first-name" value="{{ old('first-name') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-smile"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('first-name')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="last-name">Last Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="last-name" name="last-name" value="{{ old('last-name') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-smile"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('last-name')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="gender">Gender</label>
                    <div class="control">
                        <label class="radio">
                            <span class="icon is-small">
                                <i class="gg-gender-male"></i>
                            </span>
                            <input id="male" type="radio" name="gender" value="male" {{ old('gender')==='male'?'checked':'' }} required>
                            Male
                        </label>
                        <label class="radio">
                            <span class="icon is-small">
                                <i class="gg-gender-female"></i>
                            </span>
                            <input id="female" type="radio" name="gender" value="female" {{ old('gender')==='female'?'checked':'' }} required>
                            Female
                        </label>
                    </div>
                    @error('gender')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="username">Username</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="username" name="username" value="{{ old('username') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('username')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="about">About</label>
                    <div class="control">
                        <textarea class="textarea" id="about" name="about">{{ old('about') }}</textarea>
                    </div>
                    @error('about')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="email">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" id="email" name="email" value="{{ old('email') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-inbox"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="password" name="password" required>
                        <span class="icon is-small is-left">
                            <i class="gg-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('password')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="password_confirmation">Confirm Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="password_confirmation" name="password_confirmation" required>
                        <span class="icon is-small is-left">
                            <i class="gg-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="image">Image</label>
                    <div class="file has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" id="image" name="image"
                                   onchange="document.getElementById('image-name').innerText = document.getElementById('image').files[0].name;" required>
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
                    @error('image')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary" name="login">Login</button>
                    </div>

                    <div class="control">
                        <button type="reset" class="button is-warning" name="reset">Reset</button>
                    </div>
                </div>

                <div class="field">
                    <p class="is-info">
                        Don't have an account?
                        <a href="/register">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
