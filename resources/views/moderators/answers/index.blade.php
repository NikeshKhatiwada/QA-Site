<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderator Answers Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        function openModel() {
            document.getElementById('modal-js-example').classList.add('is-active');
        }
        function closeModel() {
            document.getElementById('modal-js-example').classList.remove('is-active');
        }
    </script>
</head>
<body>
<div class="columns mt-1 mb-1 is-bordered">
    <x-moderators.sidebar />
    <div class="column is-fullheight is-10">
        <div class="container">
            <div class="section">
                <h2 class="title is-2">Answers</h2>
                <hr>
                <div class="is-clearfix">
                    <div class="field has-addons is-pulled-right">
                        <form id="show-answers" method="get" action="/moderator/answers" hidden>
                            <input type="radio" title="top" id="top" name="answer_type" value="top" required>
                            <input type="radio" title="new" id="new" name="answer_type" value="new" required>
                            <input type="radio" title="old" id="old" name="answer_type" value="old" required>
                        </form>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('top').setAttribute('checked', 'checked');document.getElementById('show-answers').submit();">
                                <span>Top Voted</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('new').setAttribute('checked', 'checked');document.getElementById('show-answers').submit();">
                                <span>New</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('old').setAttribute('checked', 'checked');document.getElementById('show-answers').submit();">
                                <span>Old</span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="get" action="/moderator/users" id="user-show-form">
                    @csrf
                    <input class="input is-hidden" id="userFormA" type="text" title="answerId" name="answerId">
                </form>
                <form method="get" action="/moderator/questions" id="question-show-form">
                    @csrf
                    <input class="input is-hidden" id="questionFormA" type="text" title="answerId" name="answerId">
                </form>
                <form method="get" action="/moderator/comments" id="comment-show-form">
                    <input class="input is-hidden" id="commentFormA" type="text" title="answerId" name="answerId">
                </form>
                <form method="get" action="/moderator/reports" id="report-show-form">
                    <input class="input is-hidden" id="reportFormA" type="text" title="answerId" name="answerId">
                </form>
                <form method="post" id="delete-answer">
                    @csrf
                    @method('DELETE')
                </form>
                <table class="table is-bordered is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Answers</th>
                        <th>Posted date</th>
                        <th>Links</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <td>
                                <a onclick="document.getElementById('answer-description').innerText='{{ $answer->description }}';openModel()">
                                    {{ substr($answer->description, 0, 80). "..." }}
                                </a>
                            </td>
                            <td>{{ $answer->created_at->format('Y/m/d') }}</td>
                            <td>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="users" onclick="document.getElementById('userFormA').value='{{ $answer->id }}';document.getElementById('user-show-form').submit()">User</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="questions" onclick="document.getElementById('questionFormA').value='{{ $answer->id }}';document.getElementById('question-show-form').submit()">Question</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="comments" onclick="document.getElementById('commentFormA').value='{{ $answer->id }}';document.getElementById('comment-show-form').submit()">Comments</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="reports" onclick="document.getElementById('reportFormA').value='{{ $answer->id }}';document.getElementById('report-show-form').submit()">Reports</button>
                            </td>
                            <td>
                                <button type="button" class="button mt-1 mb-1 is-small is-danger" name="delete" onclick="document.getElementById('delete-answer').action='/answer/{{ $answer->id }}';document.getElementById('delete-answer').submit()">Delete</button>
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
            <p class="modal-card-title">Answer</p>
            <button class="delete" onclick="closeModel()"></button>
        </header>
        <section class="modal-card-body">
            <h3 class="title is-3">Description</h3>
            <div class="content" id="answer-description"></div>
        </section>
    </div>
</div>
</body>
</html>
