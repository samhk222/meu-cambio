@extends('layout')

@section('title','Notícias')

@section('content')

    <h3>Últimas notícias cadastradas</h3>

    <div class="row text-center">
        {{ $News->links() }}
    </div>

    <table width="90%" class="table table-striped table-bordered table-condensed table-hover">
        <thead>
        <tr>
            <th width="1%">#</th>
            <th>Data</th>
            <th>Título</th>
            <th>Matéria</th>
            <th>Feed</th>
        </tr>
        </thead>
        <tbody>
            @foreach($News as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->pubDate->format('d/m H:i') }}</td>
                    <td><a href='/news/{{$item->id}}/{{str_slug($item->title)}}'>{{ $item->title }}</a></td>
                    <td>{{ str_limit(strip_tags($item->description), 150, ' ...') }}</td>
                    <td>{{$item->categoria->descricao}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row text-center">
        {{ $News->links() }}
    </div>

@endsection