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
        <!-- <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button> -->
        <!-- <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="/departement/exportPdf"><i class="fas fa-download fa-sm text-white-50"></i> Print</a> -->
        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" href="{{ route('users.create') }}"><i class="fa-solid fa-plus text-white-50"></i> Add User</a>
    </form>
</div>

<table id="example" class="table table-striped text-center" style="width:100%">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Posisi</th>
            <th scope="col">Departemen</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="text-center text-justify" style="line-height: 1.9 em;">
        <?php $i = 1; ?>
        @foreach ($users as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->position}}</td>
            <td>{{ $item->departement }}</td>
            <td>
                <form action="{{ route('users.destroy',$item->id) }}" method="Post">
                    <a href="{{ route('users.edit',$item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    &nbsp;
                    @csrf
                    @method('DELETE')
                    <button class="btn" onClick="confimDelete()" type="submit"><i class="fa-sharp fa-solid text-danger fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection