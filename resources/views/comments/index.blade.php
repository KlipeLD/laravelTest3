<div id="wrapper">
    <div id="page" class="container">
            <div id="content">
                <div id="sidebar2">
                    <ul class="style1">
                        @forelse($comments as $comment)
                            <li class="first">
                                <h3>
                                    {{$comment->subject}}
                                </h3>
                                <p>{{$comment->body}}</p>
                            </li>
                        @empty
                            <p>No comments yet</p>
                        @endforelse
                    </ul>
                </div>
            </div>
    </div>
</div>
