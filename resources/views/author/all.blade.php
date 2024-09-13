@extends('layouts.app')

@section('content')
    <div style="display: flex">
        <div style="flex: 2">
<h4>Список авторів:</h4>
<table border="2">
    <thead>
    <tr>
        <th width="30px">№</th>
        <th width="60px">Прізвище</th>
        <th width="60px">Ім'я</th>
        <th width="70px">По-батькові</th>
        <th width="70px">Видалити</th>
    </tr>
    </thead>
    <tbody>
    @foreach($author as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td><a href="{{route('author.show', $item->id)}}">{{$item->surname}}</a> </td>
            <td>{{$item->name}}</td>
            <td>{{$item->middle_name ?? ''}}</td>
            <td>
                <button class="delete-author" data-id="{{$item->id}}"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
        </div>
        <div style="flex: 2; margin-left: 30px;">
            <form action="{{route('author.all')}}" method="GET">
                <div class="form-group">
                    <label>Імена:</label>
                    @foreach($uniqueNames as $item)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="name[]" value="{{$item->name}}"
                            id="name_{{$item->name}}"
                            @if(in_array($item->name, request()->input('name', []))) checked
                                   @endif>
                            <label class="form-check-label" for="name_{{$item->name}}">
                                {{$item->name}}
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Застосувати</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-author').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let authorId = this.getAttribute('data-id');
                    if (confirm('Ви впевнені, що хочете видалити цього автора?')) {
                        fetch(`/author/${authorId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Автор успішно видалений!');
                                    location.reload();
                                } else {
                                    alert('Сталася помилка при видаленні.');
                                }
                            });
                    }
                });
            });
        });
    </script>
@endsection
