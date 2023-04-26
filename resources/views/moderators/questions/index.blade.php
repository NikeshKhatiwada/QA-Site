<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderator Questions Page</title>
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
                <h2 class="title is-2">Questions</h2>
                <hr>
                <div class="is-clearfix">
                    <div class="field has-addons is-pulled-right">
                        <form id="show-questions" method="get" action="/moderator/questions" hidden>
                            <input type="radio" title="top" id="top" name="question_type" value="top" required>
                            <input type="radio" title="new" id="new" name="question_type" value="new" required>
                            <input type="radio" title="old" id="old" name="question_type" value="old" required>
                        </form>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('top').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                                <span>Top Voted</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('new').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                                <span>New</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('old').setAttribute('checked', 'checked');document.getElementById('show-questions').submit();">
                                <span>Old</span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="get" action="/moderator/users" id="user-show-form">
                    @csrf
                    <input class="input is-hidden" id="userFormQ" type="text" title="questionId" name="questionId">
                </form>
                <form method="get" action="/moderator/answers" id="answer-show-form">
                    @csrf
                    <input class="input is-hidden" id="answerFormQ" type="text" title="questionId" name="questionId">
                </form>
                <form method="get" action="/moderator/tags" id="tag-show-form">
                    <input class="input is-hidden" id="tagFormQ" type="text" title="questionId" name="questionId">
                </form>
                <form method="get" action="/moderator/reports" id="report-show-form">
                    <input class="input is-hidden" id="reportFormQ" type="text" title="questionId" name="questionId">
                </form>
                <form method="post" id="delete-question">
                    @csrf
                    @method('DELETE')
                </form>
                <table class="table is-bordered is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Questions</th>
                        <th>Posted date</th>
                        <th>Links</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>
                                    <a onclick="document.getElementById('question-title').innerText='{{ $question->title }}';document.getElementById('question-description').innerText='{{ $question->description }}';openModel()">
                                        {{ substr($question->title, 0, 80). "..." }}
                                    </a>
                                </td>
                                <td>{{ $question->created_at->format('Y/m/d') }}</td>
                                <td>
                                    <button type="button" class="button mt-1 mb-1 is-small is-link" name="users" onclick="document.getElementById('userFormQ').value='{{ $question->id }}';document.getElementById('user-show-form').submit()">User</button>
                                    <button type="button" class="button mt-1 mb-1 is-small is-link" name="answers" onclick="document.getElementById('answerFormQ').value='{{ $question->id }}';document.getElementById('answer-show-form').submit()">Answers</button>
                                    <button type="button" class="button mt-1 mb-1 is-small is-link" name="tags" onclick="document.getElementById('tagFormQ').value='{{ $question->id }}';document.getElementById('tag-show-form').submit()">Tags</button>
                                    <button type="button" class="button mt-1 mb-1 is-small is-link" name="reports" onclick="document.getElementById('reportFormQ').value='{{ $question->id }}';document.getElementById('report-show-form').submit()">Reports</button>
                                </td>
                                <td>
                                    <button type="button" class="button mt-1 mb-1 is-small is-danger" name="delete" onclick="document.getElementById('delete-question').action='/question/{{ $question->id }}';document.getElementById('delete-question').submit()">Delete</button>
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
            <p class="modal-card-title">Question</p>
            <button class="delete" onclick="closeModel()"></button>
        </header>
        <section class="modal-card-body">
            <h3 class="title is-3">Title</h3>
            <div class="content" id="question-title"></div>
            <h3 class="title is-3">Description</h3>
            <div class="content" id="question-description"></div>
        </section>
    </div>
</div>
</body>
</html>
