<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://css.gg/css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="http://tzdata-javascript.org/tzdata-javascript.js"></script>
    <script>
        let timezones = Object.keys(tzdata_javascript.timezones()).sort();
    </script>
</head>
<body>
<x-navbar />
<div class="container">
    <div class="columns is-vcentered is-centered">
        <div class="column is-half box mt-6 mb-6">
            <h3 class="title is-3">Edit Profile</h3>

            <form method="post" action="">
                @csrf
                @method('PATCH')
                <div class="field">
                    <label class="label" for="first-name">First Name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="first-name" name="first-name" value="Suman" required>
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
                        <input class="input" type="text" id="last-name" name="last-name" value="Kafle" required>
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
                            <input id="male" type="radio" name="gender" value="male" checked required>
                            Male
                        </label>
                        <label class="radio">
                            <span class="icon is-small">
                                <i class="gg-gender-female"></i>
                            </span>
                            <input id="female" type="radio" name="gender" value="female" required>
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
                        <input class="input" type="text" id="username" name="username" value="SumanKafle" required>
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
                        <textarea class="textarea" id="about" name="about">I am Suman.</textarea>
                    </div>
                    @error('about')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label" for="email">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" id="email" name="email" value="sumankafle@email.org" required>
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
                            <input class="file-input" type="file" id="image" name="image" placeholder="Enter an image" onchange="document.getElementById('image-name').innerText = document.getElementById('image').files[0].name;">
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
                    <label class="label" for="address">Address</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" id="address" name="address" value="Suryodaya" required>
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
                        <input class="input" type="text" id="district" name="district" value="Ilam" required>
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
                        <input class="input" type="text" id="country" name="country" value="Nepal" required>
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
                                        if(timezone_option.value === "Asia/Katmandu") {
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

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary" name="login">Submit</button>
                    </div>

                    <div class="control">
                        <button type="reset" class="button is-warning" name="reset">Reset</button>
                    </div>

                    <div class="control">
                        <button type="submit" class="button is-danger" name="delete" onclick="document.getElementById('delete-profile').submit()">Delete</button>
                    </div>
                </div>
            </form>

            <form method="post" id="delete-profile" action="/profile/">
                @csrf
                @method('DELETE')
            </form>

        </div>
    </div>
</div>
</body>
</html>
