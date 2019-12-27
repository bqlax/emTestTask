@extends('layouts.app')

@section('content')

    <a href=" {{ route('room.photos.create') }} " style="font-size: 5rem;">
        <i class="glyphicon-plus"></i>
    </a>

    {{--@foreach($news as $article)
        {{ $article->title }}
        {{ $article->short_text }}
        {{ $article->text }}
    @endforeach--}}
@endsection