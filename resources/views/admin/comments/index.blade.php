@extends ('layout')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div id="sidebar2">
                    <ul class="style1">
                        <table>
                            <tr>
                                <th>
                                     Пользователь
                                </th>
                                <th>
                                    Дата публикации
                                </th>
                                <th>
                                    Заголовок
                                </th>
                                <th>
                                    Комментарий
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse($comments as $comment)
                                <tr>
                                    <td>
                                        {{$comment->user_name}}
                                    </td>
                                    <td>
                                        {{$comment->created_at}}
                                    </td>
                                    <td>
                                        {{$comment->subject}}
                                    </td>
                                    <td>
                                        {{$comment->body}}
                                    </td>
                                    <td><a href="/acomments/{{$comment->id}}/add"><i class="fa fa-check" aria-hidden="true"></i></a></td>
                                    <td><a href="/acomments/{{$comment->id}}/del"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                </tr>

                            @empty
                                <p>No relevant articles yet</p>
                            @endforelse
                        </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
