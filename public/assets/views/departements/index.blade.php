@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Hai, {{auth()->user()->name}}</strong> {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
    <a class="btn btn-secondary" href="{{ route('departements.create') }}"> Add Departements</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
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
            <td>
                <form action="{{ route('departements.destroy',$item->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('departements.edit',$item->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection