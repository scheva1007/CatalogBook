@extends('layouts.app')

@section('content')
<h4>Список авторів:</h4>
<table border="2">
    <thead>
    <tr>
        <th width="10px">№п/п</th>
        <th width="60px">Прізвище</th>
        <th width="60px">Ім'я</th>
        <th width="70px">По-батькові</th>
    </tr>
    </thead>
    <tbody>
    @foreach($author as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td><a href="{{route('author.show', $item->id)}}">{{$item->surname}}</a> </td>
            <td>{{$item->name}}</td>
            <td>{{$item->middle_name ?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
