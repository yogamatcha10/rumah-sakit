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
        <!-- <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href=""><i class="fas fa-download fa-sm text-white-50"></i> Print</a> -->
        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" href="{{ route('dokters.create') }}"><i class="fa-solid fa-plus text-white-50"></i> Add Resep</a>
    </form>
</div>

<table id="example" class="table table-striped text-center" style="width:100%">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Kode Reseo</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Tanggal Praktik</th>
            <th scope="col">Spesialis</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="text-center text-justify" style="line-height: 1.9 em;">
        <?php $i = 1; ?>
        @foreach ($dokters as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->no_resep }}</td>
            <td>{{ $item->nama_dokter }}</td>
            <td>{{ $item->tgl_praktik }}</td>
            <td>{{ $item->spesialis }}</td>
            <td>
                <form action="{{ route('dokters.destroy',$item->id) }}" method="Post">
                    <a href="{{ route('dokters.edit',$item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
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