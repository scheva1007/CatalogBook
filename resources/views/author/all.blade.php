@extends('layouts.app')

@section('content')
    <div style="display: flex">
        <div style="flex: 2">
<h4>Список авторів:</h4>
<table border="2">
    <thead>
    <tr>
        <th width="30px">№</th>
        <th width="90px">Прізвище</th>
        <th width="80px">Ім'я</th>
        <th width="110px">По-батькові</th>
        <th width="100px">Редагувати</th>
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
                <button class="edit-author" data-id="{{$item->id}}" data-toggle="modal" data-target="#editAuthorModal">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
            <td>
                <button class="delete-author" data-id="{{$item->id}}"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
            <div class="mt-3">
                {{ $author->links() }}
            </div>
        </div>
        <div class="modal fade" id="editAuthorModal" tabindex="-1" role="dialog" aria-labelledby="editAuthorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAuthorModalLabel">Редагувати автора:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAuthorForm">
                            <input type="hidden" id="edit-author-id" name="author_id">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="edit-surname">Прізвище:</label>
                                <input type="text" class="form-control" id="edit-surname" name="surname" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-name">Ім'я:</label>
                                <input type="text" class="form-control" id="edit-name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-middle-name">По-батькові:</label>
                                <input type="text" class="form-control" id="edit-middle-name" name="middle_name">
                            </div>
                            <button type="submit" class="btn btn-primary">Зберегти</button>
                        </form>
                    </div>
                </div>
            </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-author').forEach(button => {
                button.addEventListener('click', function () {
                    let authorId = this.getAttribute('data-id');
                    fetch(`/author/${authorId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit-author-id').value = data.author.id;
                            document.getElementById('edit-surname').value = data.author.surname;
                            document.getElementById('edit-name').value = data.author.name;
                            document.getElementById('edit-middle-name').value = data.author.middle_name || '';
                            $('#editAuthorModal').modal('show');
                        });
                });
            });
            document.getElementById('editAuthorForm').addEventListener('submit', function (e) {
                e.preventDefault();
                let authorId = document.getElementById('edit-author-id').value;
                let formData = new FormData(this);

                fetch(`/author/${authorId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let authorRow = document.querySelector(`.edit-author[data-id='${authorId}']`).closest('tr');
                        authorRow.querySelector('td:nth-child(2)').innerHTML = `<a href="/author/${authorId}">${data.author.surname}</a>`;
                        authorRow.querySelector('td:nth-child(3)').textContent = data.author.name;
                        authorRow.querySelector('td:nth-child(4)').textContent = data.author.middle_name || '';
                        $('#editAuthorModal').modal('hide');
                    } else  {
                        alert('Помилка при оновленні');
                    }
                })
                    .catch(error => console.error('Помилка:', error));
            });
        });
    </script>

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
            })
        })
    </script>
@endsection
