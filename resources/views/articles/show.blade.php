@extends ('layout')
@section('head')

    <link href="/css/comment.css" rel="stylesheet"/>
    <script src="/js/comment.js"></script>
    <script src="/js/likes.js"></script>
    <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
    <script type="text/javascript" src="/js/jquery.js"></script>
@endsection
@section ('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <H1 class="heading has-text-weight-bold is-size-4">{{$article->title}}</h1>
                    <span class="heading is-size-14">{{$article->short_body}}</span>
                </div>
                <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
                <p>{{$article->body}}</p>
                <p>Количество просмотров: </p><p id="views"></p>
                <p>Количество лайков: </p><p id="likes"></p>
                <p><img onclick="changeLike();" src="/images/elements/like.png" alt="like"  /></p>
                <p>
                    @foreach ($article->tags as $tag)
                        <a href="{{route('articles.index',['tag'=>$tag->name])}}">{{$tag->name}}</a>
                    @endforeach
                </p>
            </div>

        </div>
    </div>
    <script>
        function showViews()
        {
            $.ajax({
                url: "/views",
                cache: false,
                data: {text: document.location.pathname},
                success: function(html){
                    $("#views").html(html);
                }
            });
        }
        function showLikes()
        {
            $.ajax({
                url: "/likes",
                cache: false,
                data: {text: document.location.pathname},
                success: function(html){
                    $("#likes").html(html);
                }
            });
        }
        function changeComment()
        {
            $.ajax({
                url: "/changeComment",
                cache: false,
                success: function(html){
                    $("#comment").html(html);
                }
            });
        }
        function changeLike()
        {
            $.ajax({
                url: "/clicklike",
                cache: false,
                data: {text: document.location.pathname },
                success: function(html)
                {
                    $("#likes").html(html);
                }
            });
        }
        $(document).ready(function(){
            showViews();
            showLikes();
            setInterval('showViews()',1000);
            setInterval('showLikes()',1000);
            $('#contactform').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '/addcomment',
                    data: $('#contactform').serialize(),
                    success: function (data) {
                        if (data.result) {
                            $('#senderror').hide();
                            $('#sendmessage').show();
                        } else {
                            $('#senderror').show();
                            $('#sendmessage').hide();
                        }
                    },
                    error: function () {
                        $('#senderror').show();
                        $('#sendmessage').hide();
                    }
                });
            });
        });
    </script>
    @include('comments.create')
    @include('comments.index')

@endsection
