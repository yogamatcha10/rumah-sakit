@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Hai, {{auth()->user()->name}}</strong> {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-none d-sm-inline-block text-end mb-2">
    <form action="/report/generate" method="POST">
        @csrf
        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" href="{{ route('departements.create') }}"><i class="fa-solid fa-plus text-white-50"></i> Add Departement</a>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Manager ID</th>
            <th scope="col">Action</th>
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
            <td>
                <form action="{{ route('departements.destroy',$item->id) }}" method="Post">
                    <a href="{{ route('departements.edit',$item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    @csrf
                    @method('DELETE')
                    <button class="btn m-2" onClick="confimDelete()" type="submit"><i class="fa-sharp fa-solid text-danger fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection