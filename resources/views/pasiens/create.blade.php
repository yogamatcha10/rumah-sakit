@extends('app')
@section('content')
<form action="{{ route('pasiens.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Pasien:</strong>
                <input type="text" name="nama_pasien" class="form-control" placeholder="Masukan Nama Pasien">
                @error('name_pasien')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Lokasi:</strong>
                <input type="text" name="location" class="form-control" placeholder="Masukan Lokasi">
                @error('lokasi')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <label for="manager_id"><strong>Manager:</strong></label>
        <select name="manager_id" class="form-control">
        <option value="" disabled selected>Pilih</option>
            @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
    </div>
        </div>
        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Nama / Kode Product">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 form-group">
                <button class="btn btn-secondary" type="button" name="btnAdd" id="btnAdd"><i class="fa fa-plus"></i>Tambah</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <table id="example" class="table table-striped text-center" style="width:100%">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Manager</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
   
</table>
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
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.pasien') }}";
  
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
           console.log(ui.item); 
           return false;
        }
      });
  
</script>
@endsection