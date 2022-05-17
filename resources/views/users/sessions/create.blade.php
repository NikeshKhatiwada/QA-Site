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
                    <label class="label" for="email">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" id="email" name="email" placeholder="myemail@email.com" value="{{ old('email') }}">
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
