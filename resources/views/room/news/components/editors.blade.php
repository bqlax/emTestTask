@if(Auth::user()->id == $article->created_by)
    <form class="editors" onsubmit="return confirm('Удалить?')" action="{{route('room.news.destroy', $article)}}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        {{csrf_field()}}
        <a class="btn btn-default" href="{{ route('room.news.edit', $article) }}">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
        <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </button>
    </form>
@endif