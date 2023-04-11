@section('content')
<html>
    <head>
    <h1>Departement Report</h1>
    </head>
<h1>Departement Report</h1>
<table class="table">
<thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Manager ID</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
        @foreach ($departements as $item)
        <tr>
            <td class="text-center">{{ $i++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->manager_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>
@endsection