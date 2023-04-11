@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Hai, {{auth()->user()->name}}</strong> {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" href="{{ route('positions.create') }}"> Add Position</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Alias</th>
            <th scope="col">Action</th>
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
            <td>
                <form action="{{ route('positions.destroy',$item->id) }}" method="Post">
                    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('positions.edit',$item->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection