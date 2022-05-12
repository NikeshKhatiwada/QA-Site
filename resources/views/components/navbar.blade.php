<nav class="navbar is-light" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/home">Home</a>
            <a class="navbar-item" href="/tags">Tags</a>
            <a class="navbar-item" href="/users">Users</a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    More
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/about">
                        About
                    </a>
                    <a class="navbar-item" href="/contact">
                        Contact
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-ghost" href="/search">
                        <i class="gg-search"></i>
                    </a>

                    <a class="button is-ghost" href="/notifications">
                        <i class="gg-bell"></i>
                    </a>

                    <a class="button is-ghost" href="/profile">
                        <i class="gg-profile"></i>
                    </a>

                    <form method="post" action="/logout">
                        <button type="submit" class="button is-ghost">
                            <i class="gg-log-out"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
