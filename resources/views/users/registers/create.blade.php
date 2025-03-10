<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="http://tzdata-javascript.org/tzdata-javascript.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-tags-multiple').select2();
        });
    </script>
    <script>
        let timezones = Object.keys(tzdata_javascript.timezones()).sort();
    </script>
</head>
<body>
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half box mt-6 mb-6">
            <h3 class="title is-3">Register Page</h3>
            <form method="post" enctype="multipart/form-data" action="/register">
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
                            <input id="male" type="radio" name="gender" value="male" {{ (old('gender')==='male')?'checked':'' }} required>
                            Male
                        </label>
                        <label class="radio">
                            <span class="icon is-small">
                                <i class="gg-gender-female"></i>
                            </span>
                            <input id="female" type="radio" name="gender" value="female" {{ (old('gender')==='female')?'checked':'' }} required>
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
                    <label class="label" for="image">Image</label>
                    <div class="file has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" id="image" name="image" placeholder="Enter an image" required onchange="document.getElementById('image-name').innerText = document.getElementById('image').files[0].name;">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="gg-file-add"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file…
                                </span>
                                <span class="icon is-small">
                                    <i class="gg-check"></i>
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

                <div class="field">
                    <label class="label" for="tags">Tags</label>
                    <div class="is-multiple">
                        <select class="input js-tags-multiple" id="tags" name="tags[]" size="6" multiple="multiple" required>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->slug }}" {{ in_array($tag->slug, old('tags')?:[])?'selected':'' }}>
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
                    <label class="label" for="address">Address</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="address" name="address" value="{{ old('address') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-home"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('address')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="district">District</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="district" name="district" value="{{ old('district') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-pin"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('district')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="country">Country</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="country" name="country" value="{{ old('country') }}" required>
                        <span class="icon is-small is-left">
                            <i class="gg-globe-alt"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('country')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="timezone">Timezone</label>
                    <div class="control has-icons-left has-icons-right">
                        <div class="select is-fullwidth">
                            <select id="timezone" name="timezone" required>
                                <script>
                                    timezones.forEach(timezone => {
                                        document.getElementById('timezone').innerHTML += "<option value=" + timezone + ">" + timezone + "</option>";
                                    });
                                    let timezone_options = document.getElementById('timezone').childNodes;
                                    timezone_options.forEach(timezone_option => {
                                        if(timezone_option.value === Intl.DateTimeFormat().resolvedOptions().timeZone) {
                                            timezone_option.setAttribute("selected", "selected")
                                        }
                                    })
                                </script>
                            </select>
                            <span class="icon is-small is-left">
                            <i class="gg-time"></i>
                        </span>
                            <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                        </div>
                    </div>
                    @error('timezone')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="password" name="password" autocomplete="password" required>
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
                        <input class="input" type="password" id="password_confirmation" name="password_confirmation" autocomplete="password" required>
                        <span class="icon is-small is-left">
                            <i class="gg-lock"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="gg-check"></i>
                        </span>
                    </div>
                    @error('confirm-password')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary" name="login">Register</button>
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
