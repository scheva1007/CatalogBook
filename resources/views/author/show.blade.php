@extends('layouts.app')
@section('content')
    <h5 class="my-indent">{{$author->surname}} {{$author->name}}  {{$author->middle_name}}</h5>
    <div>
        <a href="{{route('author.edit', $author->id)}}">Редагувати</a>
        <form method="post" action="{{route('author.destroy', $author->id)}}" onsubmit="return confirm('Ви впевнені?')" style="margin-top: 20px;">
            @csrf
        @method('DELETE')
            <button type="submit" class="btn btn-primary">Видалити</button>
        </form>
    </div>
@endsection
