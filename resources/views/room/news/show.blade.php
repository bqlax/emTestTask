@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-sub-heading_spacer">
                        <h1>{{ $article->title }}</h1>
                        <likes
                                :route="'{{ url('/like') }}'"
                                :id="{{ $article->id }}"
                                :type="'news'"
                                :likes="{{ $article->likes ?? 0}}"
                                :is_like="{{ $isLiked ? 'true' : 'false' }}"
                        ></likes>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="lead">{{ $article->text }}</p>
                </div>
                <div class="panel-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-primary" role="button">К списку</a>
                    @include('room.news.components.editors')
                </div>
            </div>
        </div>
    </div>

@endsection