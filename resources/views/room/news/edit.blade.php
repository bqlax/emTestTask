@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="mt-4 mb-4">Редактирование новости</h2>
        <news-form
                :news="{{ json_encode($news->toArray(), JSON_UNESCAPED_UNICODE) }}"
                :method="'put'"
                :action="'{{ route('room.news.update', $news) }}'"
        >
        </news-form>
    </div>
@endsection