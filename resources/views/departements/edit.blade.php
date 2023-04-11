@extends('app')
@section('content')
<form action="{{ route('departements.update', $departement->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $departement->name }}" class="form-control" placeholder="Masukan Nama">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi:</strong>
                <input type="text" name="location" value="{{ $departement->location }}" class="form-control" placeholder="Masukan Lokasi">
                @error('lokasi')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <label for="manager_id"><strong>Manager:</strong></label>
        <select name="manager_id" class="form-control">
            @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</form>
@endsection