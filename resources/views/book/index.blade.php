@extends('layouts.app')

@section('content')
<div style="display: flex">
    <div style="flex: 3; ">
<h3 style="margin-left: 250px;">Список книг</h3>
<table border="2" class="indent-bottom">
    <thead>
    <tr>
        <th width="30px">№</th>
        <th width="120px"> Назва книги</th>
        <th width="120px">Короткий опис</th>
        <th width="190px">Автори</th>
        <th width="150px">Дата публікації</th>
    </tr>
    </thead>
    <tbody>
        @foreach($book as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="{{route('book.show', $item->id)}}">{{$item->title}}</a></td>
                <td>{{$item->short_description}}</td>
                <td>
                    @foreach($item->author as $author)
                        {{$author->surname}}  {{$author->name}}
                        <br>
                    @endforeach
                </td>
                <td>{{$item->created_at->format('d.m.Y')}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
    <div class="justify-content-start" style="flex: 1; margin-left: 30px;">
    <div style="margin-bottom: 30px;">
        <form action="{{ route('book.all') }}" method="GET">
    <div class="form-group">
        <label for="author">Автори:</label>
        @foreach($allAuthors as $author)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="author[]" value="{{ $author->id }}"
                           id="author_{{ $author->id }}"
                           @if(in_array($author->id, request()->input('author', [])))
                           checked
                        @endif>
                    <label class="form-check-label" for="author_{{ $author->id }}">
                        {{ $author->surname }} {{ $author->name }}
                    </label>
                </div>
            @endforeach
        <button type="submit" class="btn btn-primary mt-3">Застосувати</button>
    </div>
</form>
    </div>
    <div>
        <form action="{{route('book.all')}}" method="GET">
            <div>
                <input type="text" name="title" class="form-control my-indent author-indent" placeholder="пошук книги за назвою"
                       value="{{request()->input('title')}}">
                <button type="submit" class="btb btn-primary">Пошук</button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
