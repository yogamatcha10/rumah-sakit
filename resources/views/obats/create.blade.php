@extends('app')
@section('content')
<form action="{{ route('obats.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Obat:</strong>
                <input type="text" name="nama_obat" class="form-control" placeholder="Masukan Nama">
                @error('nama_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Obat:</strong>
                <input type="text" name="jenis_obat" class="form-control" placeholder="Masukan Jenis Obat">
                @error('jenis_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga :</strong>
                <input type="number" name="harga" class="form-control" placeholder="Rp. 0">
                @error('harga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>


    </div>
</form>
@endsection