@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mt-4 mb-4">Создание категории</h2>
        <news-form
                :news="{{ json_encode($news) }}"
                :method="'create'"
                :action="'{{ route('room.news.store') }}'"
        >
        </news-form>
    </div>
@endsection