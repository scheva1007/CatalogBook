@extends('layouts.app')
@section('content')
    <div>
        <h5>Автор(и):</h5>
        <ul class="container">
            @foreach($book->author as $author)
                <li>{{$author->surname}}  {{$author->name}}</li>
            @endforeach
        </ul>
    </div>
    <div>
        <h4>{{$book->title}}</h4>
    </div>
    <div>
        @if($book->image)
            <img src='{{asset('/storage/' . $book->image)}}' alt="{{$book->title}}" style="max-width: 300px; max-height: 300px;">
        @endif
</div>
    <div style="margin-top: 20px;">
        <h5>Короткий опис:</h5>
        <p>{{$book->short_description}}</p>
    </div>
    <div>
        <a href="{{route('book.edit', $book->id)}}" >Редагувати</a>
        <form method="post" action="{{route('book.destroy', $book->id)}}" onsubmit="return confirm('Ви впевнені?')" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-primary">Видалити</button>
        </form>
    </div>
@endsection



