<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<x-navbar />
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half box mt-6 mb-6">
            <h3 class="title is-3">Edit Password</h3>

            <form method="post" action="/profile/password/">
                @csrf
                @method('PATCH')
                <div class="field">
                    <label class="label" for="current-password">Current Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="current-password" name="current-password" placeholder="X12M?+abc().">
                        <span class="icon is-small is-left">
                            <i class="gg-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('current-password')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="new-password">New Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="new-password" name="new-password" placeholder="X12M?+abc().">
                        <span class="icon is-small is-left">
                            <i class="gg-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('new-password')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="new-password_confirmation">Confirm New Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="new-password_confirmation" name="new-password_confirmation" placeholder="X12M?+abc().">
                        <span class="icon is-small is-left">
                            <i class="gg-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('new-password_confirmation')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary" name="save">Submit</button>
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
