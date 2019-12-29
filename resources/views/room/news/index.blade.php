@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <h1>Новости</h1>

            <div class="row" style="margin-bottom: 2rem;">
                <div class="col-lg-3">
                    <a href="{{ route('room.news.create') }}" class="btn btn-primary btn-block" role="button">Добавить</a>
                </div>
            </div>

            <div class="row posts">
                <div class="col-lg-12">
                    @foreach($news as $article)
                        <div class="thumbnail posts__item">
                            <div class="caption">
                                <h3>{{ $article->title }}</h3>
                                <div class="posts__body">{{ $article->text_short }}</div>
                                <div class="panel-sub-heading_spacer">
                                    <div>
                                        <a href="{{ route('room.news.show', $article->slug) }}" class="btn btn-primary" role="button">Посмотерть</a>
                                        @include('room.news.components.editors')
                                    </div>
                                    <likes
                                            :route="'{{ url('/like') }}'"
                                            :id="{{ $article->id }}"
                                            :type="'news'"
                                            :likes="{{ $article->likes ?? 0}}"
                                            :is_like="{{ isset($liked[$article->id]) ? 'true' : 'false' }}"
                                    ></likes>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{$news->links()}}

        </div>
    </div>

@endsection