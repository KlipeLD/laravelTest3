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
                                    Заголовок
                                </th>
                                <th>
                                    Категория
                                </th>
                                <th>
                                    Дата публикации
                                </th>
                                <th>
                                    Количество лайков
                                </th>
                                <th>
                                    Количество просмотров
                                </th>
                                <th>
                                    Статус публикации
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        @forelse($articles as $article)
                                <tr>
                                    <td>
                                        {{$article->title}}
                                    </td>
                                    <td>
                                        {{$article->art_cat}}
                                    </td>
                                    <td>
                                        {{$article->created_at}}
                                    </td>
                                    <td>
                                        {{$article->likes}}
                                    </td>
                                    <td>
                                        {{$article->views}}
                                    </td>
                                    <td>
                                        {{$article->art_status}}
                                    </td>
                                    <td><a href="/articles/{{$article->slug}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                    <td><a href="/articles/{{$article->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                    <td><a href="/articles/{{$article->id}}/novis"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></td>
                                    <td><a href="/aarticles/{{$article->id}}/del"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                </tr>

                        @empty
                            <p>No relevant articles yet</p>
                        @endforelse
                        </table>
                    </ul>
                </div>
            </div>
        </div>
        @if(!request('tag'))
        <p>{{ $articles->links() }}</p>
        @endif
    </div>
@endsection
