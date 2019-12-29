@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="panel-sub-heading_spacer">
                        <h1>{{ $photo->name }}</h1>
                        <likes
                                :route="'{{ url('/like') }}'"
                                :id="{{ $photo->id }}"
                                :type="'photo'"
                                :likes="{{ $photo->likes ?? 0}}"
                                :is_like="{{ $isLiked ? 'true' : 'false' }}"
                        ></likes>
                    </div>
                </div>
                <div class="panel-body">
                    <img class="panel-body__img" src="{{ asset($photo->path) }}" alt="{{ $photo->name }}">
                </div>
                <div class="panel-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-primary" role="button">К списку</a>
                    @include('room.photos.components.editors')
                </div>
            </div>
        </div>
    </div>

@endsection