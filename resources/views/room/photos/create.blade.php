@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="mt-4 mb-4">Добавить фото</h2>
        <photo-form
                :photo="{{ json_encode($photo) }}"
                :nophoto="'{{ asset('storage/no-photo.png') }}'"
                :method="'create'"
                :action="'{{ route('room.photos.store') }}'"
        >
        </photo-form>
    </div>
@endsection