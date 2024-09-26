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
        <th width="200px">Короткий опис</th>
        <th width="300px">Автори</th>
        <th width="150px">Дата публікації</th>
        <th width="70px">Редагувати</th>
        <th width="70px">Видалити</th>
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
                <td>
                    <button class="edit-book" data-id="{{$item->id}}" data-toggle="modal" data-target="#editBookModal">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="delete-author" data-id="{{$item->id}}"><i class="fas fa-trash"></i> </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
        <div class="mb-3">
            {{ $book->links() }}
        </div>
    </div>
    <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Редагувати книгу</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBookForm" enctype="multipart/form-data">
                        <input type="hidden" id="edit-book-id" name="book_id">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="edit-title">Назва книги</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="edit-short-description">Короткий опис</label>
                                <textarea class="form-control" id="edit-short-description" name="short_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit-authors">Автори:</label>
                                <select id="edit-authors" name="author[]" class="form-control" multiple required>
                                    <!-- Здесь будут динамически добавляться авторы через JavaScript -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-image">Зображення:</label>
                                <input type="file" id="edit-image" name="image" class="form-control">
                                <br>
                                <img id="current-image" src="" alt="Current Image" style="max-width: 200px; display: none;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                    </form>
                </div>
            </div>
        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-book').forEach(button => {
            button.addEventListener('click', function (e) {
                let bookId = this.getAttribute('data-id');

                // Получаем данные книги через AJAX
                fetch(`/book/${bookId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        // Заполняем поля формы данными книги
                        document.getElementById('edit-book-id').value = data.book.id;
                        document.getElementById('edit-title').value = data.book.title;
                        document.getElementById('edit-short-description').value = data.book.short_description;

                        let authorSelect = document.getElementById('edit-authors');
                        authorSelect.innerHTML = ''; // Очистка текущих значений

                        if (data.book.image) {
                            // Загружаем текущее изображение
                            document.getElementById('current-image').src = `/storage/${data.book.image}`;
                            document.getElementById('current-image').style.display = 'block'; // Показываем изображение
                        } else {
                            // Если изображения нет, скрываем элемент
                            document.getElementById('current-image').style.display = 'none';
                        }

                        data.authors.forEach(author => {
                            // Создаем опции для каждого автора
                            let option = document.createElement('option');
                            option.value = author.id;
                            //let middleName = author.middle_name ? '' : '';
                            option.textContent = `${author.surname} ${author.name}`.trim();

                            // Отмечаем авторов, которые уже выбраны для этой книги
                            if (data.book.author.some(a => a.id === author.id)) {
                                option.selected = true;
                            }

                            authorSelect.appendChild(option);
                        });

                        // Открываем модальное окно
                        $('#editBookModal').modal('show');
                    });
            });
        });

        // Обработка отправки формы редактирования
        document.getElementById('editBookForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let bookId = document.getElementById('edit-book-id').value;
            let formData = new FormData(this); // Собираем данные формы, включая файл
            // formData.append('_method', 'PUT');

            fetch(`/book/${bookId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData // Отправляем данные формы
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Обновляем данные книги в таблице без перезагрузки страницы
                        let bookRow = document.querySelector(`.edit-book[data-id='${bookId}']`).closest('tr');
                        bookRow.querySelector('td:nth-child(2)').innerHTML = `<a href="/book/${bookId}">${data.book.title}</a>`;
                        bookRow.querySelector('td:nth-child(3)').innerHTML = data.book.short_description; // Обновляем описание

                         // Обновляем список авторов в таблице
                        let authorList = data.authors.map(author => {
                           // let middleName = author.middle_name ? author.middle_name : '';
                            return `${author.surname} ${author.name}`.trim();
                        }).join(', ');
                        bookRow.querySelector('td:nth-child(4)').innerHTML = authorList; // Обновляем ячейку авторов

                        // Закрываем модальное окно
                        $('#editBookModal').modal('hide');
                    } else {
                        alert('Помилка при оновленні');
                    }
                })
                .catch(error => console.error('Помилка:', error));
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-author').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                let bookId = this.getAttribute('data-id');
                if (confirm('Ви впевнені, що хочете видалити цю книгу?')) {
                    fetch(`/book/${bookId}`, {
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.success) {
                                alert('Книгу успішно видалено');
                                location.reload();
                            } else {
                                alert('Сталася помилка при видаленні');
                            }
                        })

                }
            });
        });
    });
</script>
@endsection
