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
                <p>Категория:  <a href="{{route('articles.index',['category'=>$article->art_cat])}}">{{$article->art_cat}}</a></p>
                <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
                <p>{{$article->body}}</p>
                <table>
                    <tr>
                        <td>
                            <p>Дата публикации: {{$article->created_at}}</p>
                        </td>
                        <td>
                            <p><i class="fa fa-eye" aria-hidden="true"></i></p>
                        </td>
                        <td>
                            <p id="views"></p>
                        </td>
                        <td>
                            <p><i class="fa fa-heart-o" onclick="changeLike();" aria-hidden="true"></i></p>
                        </td>
                        <td>
                            <p id="likes"></p>
                        </td>
                    </tr>
                </table>

                <p>
                    @foreach ($article2->tags as $tag)
                        <a href="{{route('articles.index',['tag'=>$tag->name])}}">#{{$tag->name}}   </a>
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
