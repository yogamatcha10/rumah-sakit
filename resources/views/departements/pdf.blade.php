@extends('layout')
@section('content')

<table class="table text-center">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Manager</th>
        </tr>
    </thead>
    <tbody class="text-center text-justify" style="line-height: 1.9 em;">
        <?php $i = 1; ?>
        @foreach ($departements as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->manager->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection