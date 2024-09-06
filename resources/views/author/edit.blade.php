@extends('layouts.app')
@section('content')
    <h5 class="indent">Редагувати:</h5>
    <form method="post" action="{{route('author.update', $author->id)}}">
    @csrf
    @method('PUT')
    <div class="indent">
        <input type="text" name="surname" value="{{$author->surname}}" class="width-field">
    </div>
    <div class="indent">
        <input type="text" name="name" value="{{$author->name}}" class="width-field">
    </div>
    <div class="indent">
        <input type="text" name="middle_name" value="{{$author->middle_name}}" class="width-field">
    </div>
    <button type="submit" class="btn btn-primary">Зберегти</button>
</form>
@endsection

