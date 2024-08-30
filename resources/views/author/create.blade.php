@extends('layouts.app')

@section('content')
<form method="post" action="{{route('author.store')}}">
    @csrf
    <div class="form-group my-left">
    <label>Прізвище</label>
    <input type="text" name="surname" class="form-control" style="width: 200px;">
    </div>
    <div class="form-group">
    <label>Ім'я</label>
    <input type="text" name="name" class="form-control" style="width: 200px;">
    </div>
    <div class="form-group">
    <label>По-батькові</label>
    <input type="text" name="middle_name" class="form-control" style="width: 200px;">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Додати</button>
</form>
@endsection
