<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderator Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half box mt-6 mb-6">
            <h3 class="title is-3">Moderator Login Page</h3>
            <form method="post" action="/moderator/sessions">
                @csrf
                <div class="field">
                    <label class="label" for="username">Username</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="username" name="username" value="{{ old('username') }}">
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
                    <label class="label" for="password">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="password" name="password" placeholder="X12M?+abc()." value="{{ old('password') }}">
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

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary" name="login">Login</button>
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
