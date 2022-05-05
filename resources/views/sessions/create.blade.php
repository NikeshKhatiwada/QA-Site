<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half">
            <h1 class="is-size-3">Login Page</h1>
            <form method="post" action="">
                @csrf
                <div class="field">
                    <label class="label" for="email">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" id="email" name="email" placeholder="myemail@email.com">
                        <span class="icon is-small is-left">
                        <i class="fas fa-envelope fa-xs"></i>
                    </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check fa-xs"></i>
                        </span>
                    </div>
                    @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="password" name="password" placeholder="X12M?+abc().">
                        <span class="icon is-small is-left">
                        <i class="fas fa-envelope fa-xs"></i>
                    </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check fa-xs"></i>
                        </span>
                    </div>
                    @error('password')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link" name="login">Login</button>
                    </div>

                    <div class="control">
                        <button type="reset" class="button is-link" name="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
