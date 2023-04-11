@section('content')
<html>
    <head>
    <h1>Position Report</h1>
    </head>
<h1>Position Report</h1>
<table class="table">
<thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Alias</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
        @foreach ($positions as $item)
        <tr>
            <td class="text-center">{{ $i++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->keterangan }}</td>
            <td>{{ $item->alias }}</td>
        @endforeach
    </tbody>
</table>
</html>
@endsection