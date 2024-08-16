<h5>Список авторів</h5>
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
                <td>{{$item->surname}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->middle_name ?? ''}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
