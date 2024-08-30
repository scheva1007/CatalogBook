@extends('layouts.app')
@section('content')
<div>
<a href="{{route('author.all')}}">Всі автори:</a>
</div>
<div style="margin-top: 15px;">
    <a href="{{route('author.create')}}">Додати автора</a>
</div>
<div style="margin-top: 15px;">
<a href="{{route('book.all')}}">Список всіх книг:</a>
</div>
<div style="margin-top: 15px;">
    <a href="{{route('book.create')}}">Додати нову книгу</a>
</div>
@endsection
