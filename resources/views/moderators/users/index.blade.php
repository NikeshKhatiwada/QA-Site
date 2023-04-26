<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderator Users Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        function openModel() {
            document.getElementById('modal-js-example').classList.add('is-active');
        }
        function closeModel() {
            document.getElementById('modal-js-example').classList.remove('is-active');
        }
        function openSuspendFormModel() {
            document.getElementById('suspend-form-modal').classList.add('is-active');
        }
        function closeSuspendFormModel() {
            document.getElementById('suspend-form-modal').classList.remove('is-active');
            document.getElementById('suspend-user-info').setAttribute('hidden', 'hidden');
        }
    </script>
</head>
<body>
<div class="columns mt-1 mb-1 is-bordered">
    <x-moderators.sidebar />
    <div class="column is-fullheight is-10">
        <div class="container">
            <div class="section">
                <h2 class="title is-2">Users</h2>
                <hr>
                <div class="is-clearfix">
                    <div class="field has-addons is-pulled-right">
                        <form id="show-users" method="get" action="/moderator/users" hidden>
                            <input type="radio" title="top" id="top" name="user_type" value="top" required>
                            <input type="radio" title="new" id="new" name="user_type" value="new" required>
                            <input type="radio" title="old" id="old" name="user_type" value="old" required>
                        </form>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('top').setAttribute('checked', 'checked');document.getElementById('show-users').submit();">
                                <span>Top</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('new').setAttribute('checked', 'checked');document.getElementById('show-users').submit();">
                                <span>New</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('old').setAttribute('checked', 'checked');document.getElementById('show-users').submit();">
                                <span>Old</span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="get" action="/moderator/questions" id="question-show-form">
                    <input class="input is-hidden" id="questionFormU" type="text" title="userId" name="userId">
                </form>
                <form method="get" action="/moderator/answers" id="answer-show-form">
                    <input class="input is-hidden" id="answerFormU" type="text" title="userId" name="userId">
                </form>
                <form method="get" action="/moderator/comments" id="comment-show-form">
                    <input class="input is-hidden" id="commentFormU" type="text" title="userId" name="userId">
                </form>
                <form method="get" action="/moderator/reports" id="report-show-form">
                    <input class="input is-hidden" id="reportFormU" type="text" title="userId" name="userId">
                </form>
                <form method="post" id="unsuspend-user" action="/moderator/user/unsuspend">
                    @csrf
                    <input class="input is-hidden" id="unsuspend_user_id" type="text" title="unsuspend_user_id" name="unsuspend_user_id">
                </form>
                <table class="table is-bordered is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Users</th>
                        <th>Created date</th>
                        <th>Links</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a onclick="document.getElementById('user-name').innerText='Name: {{ $user->first_name." ".$user->last_name }}';document.getElementById('user-username').innerText='Username: {{ $user->username }}';document.getElementById('user-gender').innerText='Gender: {{ $user->gender===0?'Male':'Female' }}';document.getElementById('user-address').innerText='Address: {{ preg_replace("/[^A-Za-z0-9 ]/", '', $user->address) }}';document.getElementById('user-district').innerText='District: {{ $user->district }}';document.getElementById('user-country').innerText='Country: {{ $user->country }}';document.getElementById('user-email').innerText='Email: {{ $user->email }}';document.getElementById('user-about').innerText='{{ $user->about }}';document.getElementById('user-image').src='{{ asset('/storage/images/users/'.$user->image) }}';document.getElementById('user-image').alt='{{ $user->username }} image';openModel();">
                                    {{ substr($user->username, 0, 80). "..." }}
                                </a>
                            </td>
                            <td>{{ $user->created_at->format('Y/m/d') }}</td>
                            <td>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="questions" onclick="document.getElementById('questionFormU').value='{{ $user->id }}';document.getElementById('question-show-form').submit()">Questions</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="answers" onclick="document.getElementById('answerFormU').value='{{ $user->id }}';document.getElementById('answer-show-form').submit()">Answers</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="comments" onclick="document.getElementById('commentFormU').value='{{ $user->id }}';document.getElementById('comment-show-form').submit()">Comments</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="reports" onclick="document.getElementById('reportFormU').value='{{ $user->id }}';document.getElementById('report-show-form').submit()">Reports</button>
                            </td>
                            <td>
                                <button type="button" class="button mt-1 mb-1 is-small is-primary" name="unsuspend" onclick="document.getElementById('unsuspend_user_id').value='{{ $user->id }}';document.getElementById('unsuspend-user').submit()">Unsuspend</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-danger" name="suspend" onclick="document.getElementById('user_id').value='{{ $user->id }}';document.getElementById('suspended_till').min='{{ !is_null($user->suspended_until)?$user->suspended_until:\Carbon\Carbon::now() }}';document.getElementById('suspended_till').max='2122-12-31 23:59:59';document.getElementById('suspend-user-datetime').innerText='{{ !is_null($user->suspended_until)?$user->suspended_until:'Non' }}';document.getElementById('suspend-user-info').removeAttribute('hidden');openSuspendFormModel()">Suspend</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="modal-js-example" class="modal">
    <div class="modal-background" onclick="closeModel()"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">User</p>
            <button class="delete" onclick="closeModel()"></button>
        </header>
        <section class="modal-card-body">
            <h3 class="title is-3">User Info</h3>
            <div class="content">
                <ul>
                    <li class="is-text" id="user-name"></li>
                    <li class="is-text" id="user-username"></li>
                    <li class="is-text" id="user-gender"></li>
                    <li class="is-text" id="user-address"></li>
                    <li class="is-text" id="user-district"></li>
                    <li class="is-text" id="user-country"></li>
                    <li class="is-text" id="user-email"></li>
                </ul>
            </div>
            <h3 class="title is-3">About</h3>
            <div class="content" id="user-about"></div>
            <h3 class="title is-3">Image</h3>
            <img class="image is-128x128" id="user-image">
        </section>
    </div>
</div>
<div id="suspend-form-modal" class="modal">
    <div class="modal-background" onclick="closeSuspendFormModel()"></div>
    <div class="modal-card">
        <section class="modal-card-body">
            <h3 class="title is-3">Suspend User</h3>
            <form id="suspend-user-form" method="post" action="/moderator/user/suspend">
                @csrf
                <input class="input is-hidden" id="user_id" type="text" title="user_id" name="user_id">
                <div class="field">
                    <label class="label" for="suspended_till">Suspend Until</label>
                    <input class="input is-large" type="datetime-local" id="suspended_till" name="suspended_till" required>
                    <span class="is-text is-info" id="suspend-user-info" hidden>
                        User is suspended until: <b id="suspend-user-datetime"></b>
                    </span>
                </div>
                <div class="field">
                    <button type="button" class="button is-primary" name="button" onclick="form.submit()">Submit</button>
                </div>
            </form>
        </section>
    </div>
</div>
</body>
</html>
