@extends('app')
@section('content')
<form action="{{ route('obats.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Obat:</strong>
                <input type="text" name="nama_obat" value="{{ $obat->nama_obat }}" class="form-control"
                    placeholder="Masukan Nama">
                @error('nama_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Obat:</strong>
                <input type="text" name="jenis_obat" value="{{ $obat->jenis_obat }}" class="form-control"
                    placeholder="Masukan Lokasi">
                @error('jenis_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga :</strong>
                <input type="text" name="harga" value="{{ $obat->harga }}" class="form-control"
                    placeholder="Masukan Harga">
                @error('harga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
</form>
@endsection