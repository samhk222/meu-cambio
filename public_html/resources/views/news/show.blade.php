@extends('layout')

@section('title','Notícias')

@section('content')

    <div class="row text-center">
        <div class="col-md-12">
            <a href="/" class="btn btn-primary">Voltar</a>
        </div>
    </div>
    
    <h3>{{ $news->title }}</h3>
    
    <p class="text-justify">{!! nl2br($news->description) !!}</p>
@endsection