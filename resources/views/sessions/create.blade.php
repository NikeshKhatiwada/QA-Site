<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  </head>
  <body>
  <section class="section">
    <div class="container">
        <div class="columns is-flex is-desktop is-fullheight is-vcentered is-centered">
            <div class="column is-half">
                <div class="field">
                    <label class="label">Normal input</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" id="email" name="email" placeholder="Extra small">
                        <span class="icon is-small is-left">
                    <i class="fas fa-envelope fa-xs"></i>
                </span>
                        <span class="icon is-small is-right">
                    <i class="fas fa-check fa-xs"></i>
                </span>
                    </div>
                    <p class="help is-danger">This email is invalid</p>
                </div>

                <div class="field">
                    <label class="label">Normal input</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" id="password" name="password" placeholder="Extra small">
                        <span class="icon is-small is-left">
                    <i class="fas fa-envelope fa-xs"></i>
                </span>
                        <span class="icon is-small is-right">
                    <i class="fas fa-check fa-xs"></i>
                </span>
                    </div>
                    <p class="help is-danger">This email is invalid</p>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link">Submit</button>
                    </div>
                    <div class="control">
                        <button class="button is-link is-light">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  </body>
</html>
