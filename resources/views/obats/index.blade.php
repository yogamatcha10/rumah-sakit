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
        <!-- <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="/departement/exportPdf"><i
                class="fas fa-download fa-sm text-white-50"></i> Print</a> -->
        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" href="{{ route('obats.create') }}"><i
                class="fa-solid fa-plus text-white-50"></i> Add Obat</a>
    </form>
</div>

<table id="example" class="table table-striped text-center" style="width:100%">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama Obat</th>
            <th scope="col">Jenis Obat</th>
            <th scope="col">Harga</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="text-center text-justify" style="line-height: 1.9 em;">
        <?php $i = 1; ?>
        @foreach ($obats as $obat)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $obat->nama_obat }}</td>
            <td>{{ $obat->jenis_obat }}</td>
            <td>{{ $obat->harga }}</td>
            <td>
                <form action="{{ route('obats.destroy',$obat->id) }}" method="Post">
                    <a href="{{ route('obats.edit',$obat->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    &nbsp;
                    @csrf
                    @method('DELETE')
                    <button class="btn" onClick="confimDelete()" type="submit"><i
                            class="fa-sharp fa-solid text-danger fa-trash"></i></button>
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