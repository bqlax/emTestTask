@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <h1>Фотографии</h1>

            <div class="row" style="margin-bottom: 2rem;">
                <div class="col-lg-3">
                    <a href="{{ route('room.photos.create') }}" class="btn btn-primary btn-block" role="button">Добавить</a>
                </div>
            </div>


            <div class="row posts">
                <div class="col-lg-12">
                    @foreach($photos as $photo)
                        <div class="thumbnail posts__item">
                            <div class="caption">
                                <h3>{{ $photo->name }}</h3>
                                <div class="posts__body">
                                    <img src="{{ asset($photo->path) }}" alt="{{ $photo->name }}" style="width: 100%;">
                                </div>
                                <div class="panel-sub-heading_spacer">
                                    <div>
                                        <a href="{{ route('room.photos.show', $photo->slug) }}" class="btn btn-primary" role="button">Посмотреть</a>
                                        @include('room.photos.components.editors')
                                    </div>
                                    <likes
                                            :route="'{{ url('/like') }}'"
                                            :id="{{ $photo->id }}"
                                            :type="'photo'"
                                            :likes="{{ $photo->likes ?? 0}}"
                                            :is_like="{{ isset($liked[$photo->id]) ? 'true' : 'false' }}"
                                    ></likes>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{$photos->links()}}

        </div>
    </div>

@endsection