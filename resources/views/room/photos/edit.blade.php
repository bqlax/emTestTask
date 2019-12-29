@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="mt-4 mb-4">Редактирование</h2>
        <photo-form
                :photo="{{ json_encode($photo->toArray(), JSON_UNESCAPED_UNICODE) }}"
                :nophoto="'{{ asset('storage/no-photo.png') }}'"
                :method="'put'"
                :action="'{{ route('room.photos.update', $photo) }}'"
        >
        </photo-form>
    </div>
@endsection