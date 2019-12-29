@if(Auth::user()->id == $photo->created_by)
    <form class="editors" onsubmit="return confirm('Удалить?')" action="{{route('room.photos.destroy', $photo)}}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        {{csrf_field()}}
        <a class="btn btn-default" href="{{ route('room.photos.edit', $photo) }}">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
        <button class="btn btn-default" type="submit">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </button>
    </form>
@endif