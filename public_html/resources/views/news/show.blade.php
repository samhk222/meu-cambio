@extends('layout')

@section('title','Notícias')

@section('content')

    <h3>{{ $news->title }}</h3>
    
    <p class="text-justify">{!! nl2br($news->description) !!}</p>
@endsection