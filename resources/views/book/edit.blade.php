@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('book.update', $book->id )}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <label class="author-indent">Автори:</label>
        <select name="author[]" multiple required class="form-control my-indent" style="width: 300px;">
            @foreach($authors as $author)
                <option value="{{$author->id}}" @if($book->author->contains($author->id))
                selected
                    @endif>
                    {{$author->surname}}  {{$author->name}}  {{$author->middle_name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label>Назва:</label>
            <input type="text" name="title" value="{{$book->title}}" class="form-control width-field" >
        </div>
        <div class="form-group">
            <label>Короткий опис:</label>
            <input type="text" name="short_description" value="{{$book->short_description}}" class="form-control width-field">
        </div>
        <div class="form-group">
            <label for="image">Зображення:</label>
            <br>
            @if($book->image)
                <img src="{{ asset('/storage/' . $book->image) }}" alt="{{$book->title}}" style="max-width: 300px; max-height: 300px;">
                <br><br>
                @endif
            <input type="file" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Зберегти</button>
    </form>
@endsection
