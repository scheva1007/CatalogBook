<h3 style="margin-left: 250px;">Список книг</h3>
<table border="2">
    <thead>
    <tr>
        <th width="10px">№п/п</th>
        <th width="60px">Назва книги</th>
        <th width="120px">Короткий опис</th>
        <th width="50px">Зображення</th>
        <th width="150px">Дата публікації</th>
    </tr>
    </thead>
    <tbody>
        @foreach($book as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->short_description}}</td>
                <td>{{$item->image}}</td>
                <td>{{$item->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
