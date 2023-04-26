<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderator Tags Page</title>
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
                <h2 class="title is-2">Tags</h2>
                <hr>
                <div class="is-clearfix">
                    <div class="field has-addons is-pulled-right">
                        <form id="show-tags" method="get" action="/moderator/tags" hidden>
                            <input type="radio" title="top" id="top" name="tag_type" value="top" required>
                            <input type="radio" title="new" id="new" name="tag_type" value="new" required>
                            <input type="radio" title="old" id="old" name="tag_type" value="old" required>
                        </form>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('top').setAttribute('checked', 'checked');document.getElementById('show-tags').submit();">
                                <span>Top Followed</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('new').setAttribute('checked', 'checked');document.getElementById('show-tags').submit();">
                                <span>New</span>
                            </button>
                        </p>
                        <p class="control">
                            <button class="button is-medium" type="submit"
                                    onclick="document.getElementById('old').setAttribute('checked', 'checked');document.getElementById('show-tags').submit();">
                                <span>Old</span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="section">
                <form method="get" action="/moderator/questions" id="question-show-form">
                    <input class="input is-hidden" id="questionFormT" type="text" title="tagId" name="tagId">
                </form>
                <form method="get" action="/moderator/reports" id="report-show-form">
                    <input class="input is-hidden" id="reportFormT" type="text" title="tagId" name="tagId">
                </form>
                <form method="post" id="delete-tag">
                    @csrf
                    @method('DELETE')
                </form>
                <table class="table is-bordered is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Tags</th>
                        <th>Category</th>
                        <th>Posted date</th>
                        <th>Links</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                <a onclick="document.getElementById('tag-title').innerText='{{ $tag->title }}';document.getElementById('tag-description').innerText='{{ $tag->description }}';document.getElementById('tag-image').src='{{ asset('/storage/images/tags/'.$tag->image) }}';document.getElementById('tag-image').alt='{{ $tag->title }} image';openModel()">
                                    {{ substr($tag->title, 0, 80). "..." }}
                                </a>
                            </td>
                            <td>{{ $tag->tagCategory->name }}</td>
                            <td>{{ $tag->created_at->format('Y/m/d') }}</td>
                            <td>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="questions" onclick="document.getElementById('questionFormT').value='{{ $tag->id }}';document.getElementById('question-show-form').submit()">Questions</button>
                                <button type="button" class="button mt-1 mb-1 is-small is-link" name="reports" onclick="document.getElementById('reportFormT').value='{{ $tag->id }}';document.getElementById('report-show-form').submit()">Reports</button>
                            </td>
                            <td>
                                <button type="button" class="button mt-1 mb-1 is-small is-danger" name="delete" onclick="document.getElementById('delete-tag').action='/tag/{{ $tag->id }}';document.getElementById('delete-tag').submit()">Delete</button>
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
            <p class="modal-card-title">Tag</p>
            <button class="delete" onclick="closeModel()"></button>
        </header>
        <section class="modal-card-body">
            <h3 class="title is-3">Title</h3>
            <div class="content" id="tag-title"></div>
            <h3 class="title is-3">Description</h3>
            <div class="content" id="tag-description"></div>
            <h3 class="title is-3">Image</h3>
            <img class="image is-128x128" id="tag-image">
        </section>
    </div>
</div>
</body>
</html>
