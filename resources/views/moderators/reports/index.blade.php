<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderator Reports Page</title>
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
                <h2 class="title is-2">Reports</h2>
                <hr>
                <div class="is-clearfix">
                    <div class="field has-addons is-pulled-right">
                        <form id="show-reports" method="get" action="/moderator/reports" hidden>
                            <input type="radio" title="all" id="all" name="report_type" value="all" required>
                            <input type="radio" title="unreviewed" id="unreviewed" name="report_type" value="unreviewed" required>
                            <input type="radio" title="reviewed" id="reviewed" name="report_type" value="reviewed" required>
                        </form>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('all').setAttribute('checked', 'checked');document.getElementById('show-reports').submit();">
                                <span>All</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('unreviewed').setAttribute('checked', 'checked');document.getElementById('show-reports').submit();">
                                <span>Unreviewed</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('reviewed').setAttribute('checked', 'checked');document.getElementById('show-reports').submit();">
                                <span>Reviewed</span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="get" action="/moderator/users" id="user-show-form">
                    <input class="input is-hidden" id="userFormR" type="text" title="reportId" name="reportId">
                </form>
                <form method="get" action="/moderator/questions" id="question-show-form">
                    <input class="input is-hidden" id="questionFormR" type="text" title="reportId" name="reportId">
                </form>
                <form method="get" action="/moderator/answers" id="question-show-form">
                    <input class="input is-hidden" id="answerFormR" type="text" title="reportId" name="reportId">
                </form>
                <form method="get" action="/moderator/comments" id="question-show-form">
                    <input class="input is-hidden" id="commentFormR" type="text" title="reportId" name="reportId">
                </form>
                <form method="get" action="/moderator/tags" id="question-show-form">
                    <input class="input is-hidden" id="tagFormR" type="text" title="reportId" name="reportId">
                </form>
                <form method="post" id="accept-report" action="/moderator/report/accept">
                    @csrf
                    <input type="number" class="input" title="accept_report_id" id="accept_report_id" name="accept_report_id" required>
                </form>
                <form method="post" id="reject-report" action="/moderator/report/reject">
                    @csrf
                    <input type="text" class="input" title="reject_report_id" id="reject_report_id" name="reject_report_id" required>
                </form>
                <table class="table is-bordered is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Reports</th>
                        <th>Category</th>
                        <th>Created date</th>
                        <th>Status</th>
                        <th>Links</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>
                                <a onclick="document.getElementById('report-description').innerText='{{ $report->report_description }}';openModel()">
                                    {{ substr($report->report_description, 0, 80). "..." }}
                                </a>
                            </td>
                            <td>{{ $report->reportCategory->name }}</td>
                            <td>{{ $report->created_at->format('Y/m/d') }}</td>
                            <td>{{ ($report->status==='U')?'Unreviewed':'Reviewed' }}</td>
                            <td>
                                @if($report->report_about_category === 0)
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="users" onclick="document.getElementById('userFormR').value='{{ $report->id }}';document.getElementById('user-show-form').submit()">User</button>
                                @elseif($report->report_about_category === 1)
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="questions" onclick="document.getElementById('questionFormR').value='{{ $report->id }}';document.getElementById('question-show-form').submit()">Question</button>
                                @elseif($report->report_about_category === 2)
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="answers" onclick="document.getElementById('answerFormR').value='{{ $report->id }}';document.getElementById('answer-show-form').submit()">Answer</button>
                                @elseif($report->report_about_category === 3)
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="comments" onclick="document.getElementById('answerFormR').value='{{ $report->id }}';document.getElementById('comment-show-form').submit()">Comment</button>
                                @elseif($report->report_about_category === 10)
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="tags" onclick="document.getElementById('tagFormR').value='{{ $report->id }}';document.getElementById('tag-show-form').submit()">Tag</button>
                                @endif
                            </td>
                            <td>
                                @if($report->report_status === 'U')
                                    <button type="button" class="button mt-1 mb-1 is-small is-primary" name="accept" onclick="document.getElementById('accept_report_id').value='{{ $report->id }}';document.getElementById('accept-report').submit()">Accept</button>
                                    <button type="button" class="button mt-1 mb-1 is-small is-warning" name="reject" onclick="document.getElementById('reject_report_id').value='{{ $report->id }}';document.getElementById('reject-report').submit()">Reject</button>
                                @endif
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
            <p class="modal-card-title">Report</p>
            <button class="delete" onclick="closeModel()"></button>
        </header>
        <section class="modal-card-body">
            <h3 class="title is-3">Description</h3>
            <div class="content" id="report-description"></div>
        </section>
    </div>
</div>
</body>
</html>
