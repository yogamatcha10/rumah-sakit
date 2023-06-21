@extends('app')
@section('content')
<form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                    placeholder="Masukan Nama">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                    placeholder="Masukan Email">
                @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="text" name="password" value="{{ $user->password }}" class="form-control" placeholder="Masukan Password">
                @error('password')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="position"><strong>Posisi:</strong></label>
                <select name="position" class="form-control">
                    @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ $position->id == $user->position ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="departement"><strong>Departemen:</strong></label>
                <select name="departement" class="form-control">
                    @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}"
                        {{ $departement->id == $user->departement ? 'selected' : '' }}>
                        {{ $departement->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</form>
@endsection