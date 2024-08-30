@extends('layouts.app')

@section('content')
<form method="post" action="{{route('book.store')}}">
    @csrf
    <div class="form-group">
    <label>Назва:</label>
    <input type="text" name="title" class="form-control" style="width: 300px;">
    </div>
    <div class="form-group">
    <label>Короткий опис:</label>
    <input type="text" name="short_description" class="form-control" style="width: 300px;">
    </div>
    <div class="form-group">
        <label>Обрати автора:</label>
        <select name="author[]" multiple required class="form-control" style="width: 300px;">
            @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->surname}}  {{$author->name}}  {{$author->middle_name}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Додати</button>
</form>
@endsection
