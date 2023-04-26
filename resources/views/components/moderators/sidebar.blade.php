<aside class="menu column is-fullheight is-2">
    <p class="title is-3">Navigation</p>
    <p class="menu-label">
        General
    </p>
    <ul class="menu-list">
        <li><a>Dashboard</a></li>
        <li>
            <a>
                Profile</a>
        </li>
        <li>
            <a onclick="document.getElementById('logout-form').submit()">Logout</a>
        </li>
    </ul>
    <form id="logout-form" method="post" action="/moderator/logout" hidden>
        @csrf
        <button type="submit" class="button is-ghost">
        </button>
    </form>
    <p class="menu-label">
        Administration
    </p>
    <ul class="menu-list">
        <li>
            <a href="/moderator/users">Users</a>
        </li>
        <li>
            <a href="/moderator/questions">Questions</a>
        </li>
        <li>
            <a href="/moderator/answers">Answers</a>
        </li>
        <li>
            <a href="/moderator/comments">Comments</a>
        </li>
        <li>
            <a href="/moderator/tags">Tags</a>
        </li>
        <li>
            <a href="/moderator/reports">Reports</a>
        </li>
    </ul>
</aside>
