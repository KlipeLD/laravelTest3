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
                                    Количество публикаий
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse($categories as $category)
                                <tr>
                                    <td>
                                        {{$category->name}}
                                    </td>
                                    <td>
                                        {{$category->art_count}}
                                    </td>
                                    <td><a href="/acategory/{{$category->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                    <td><a href="/acategory/{{$category->id}}/del"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
