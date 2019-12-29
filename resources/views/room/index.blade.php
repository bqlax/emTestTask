@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="jumbotron">
                <h1>Новости</h1>
                <p><a class="btn btn-primary btn-lg" href="{{ route('room.news.index') }}" role="button">Перейти</a></p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="jumbotron">
                <h1>Фотографии</h1>
                <p><a class="btn btn-primary btn-lg" href="{{ route('room.photos.index') }}" role="button">Перейти</a></p>
            </div>
        </div>
    </div>


@endsection