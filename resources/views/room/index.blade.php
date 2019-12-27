@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="jumbotron">
                <a href="{{ route('room.news.index') }}">Новости</a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="jumbotron">
                <a href="{{ route('room.photos.index') }}">Фотогорафии</a>
            </div>
        </div>
    </div>



@endsection