@extends('app')
@section('content')
<form action="{{ route('dokters.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NO Resep:</strong>
                <input type="text" name="no_resep" class="form-control" placeholder="NO Resep">
                @error('no_resep')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Dokter :</strong>
                <input type="text" name="nama_dokter" class="form-control" placeholder="Nama Dokter ">
                @error('nama_dokter')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Praktik:</strong>
                <input type="date" name="tgl_praktik" class="form-control" placeholder="Tanggal Praktik">
                @error('tgl_praktik')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Spesialis:</strong>
                <select name="spesialis" class="form-control">
                    <option value="">Pilih Spesialis</option>
                    <option value="Gigi dan Mulut">Gigi dan Mulut</option>
                    <option value="Paru dan DOCT">Paru dan DOCT</option>
                    <option value="Organ Dalam">Organ Dalam</option>
                    <!-- Tambahkan opsi lain sesuai kebutuhan -->
                </select>
                @error('spesialis')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="form-group col-10">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Nama Obat">
                @error('search')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-2">
                <button type="button" id="btnTambah" class="btn btn-secondary">Tambah</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Jenis Obat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="detail">

                </tbody>
            </table>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="text" name="jml" class="form-control">
                <div class="form-group">
                    <strong>Grand Total:</strong>
                    <input type="text" name="total" class="form-control" placeholder="Rp. 0">
                    @error('tgl_praktik')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
    </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
var path = "{{ route('search.obat') }}";

$("#search").autocomplete({
    source: function(request, response) {
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
                search: request.term
            },
            success: function(data) {
                response(data);
            }
        });
    },
    select: function(event, ui) {
        $('#search').val(ui.item.label);
        //console.log($("input[name=jml]").val());
        if ($("input[name=jml]").val() > 0) {
            for (let i = 1; i <= $("input[name=jml]").val(); i++) {
                id = $("input[name=id_obat" + i + "]").val();
                if (id == ui.item.id) {
                    alert(ui.item.value + ' sudah ada!');
                    break;
                } else {
                    add(ui.item.id);
                }
            }
        } else {
            add(ui.item.id);
        }
        return false;
    }
});

$(document).ready(function() {
    $('#btnTambah').click(function() {
        var searchValue = $('#search').val();
        add(searchValue);
    });
});

function add(id) {
    // console.log($("path").val());
    const path = "{{ route('obats.index') }}/" + id;
    console.log(path);
    var html = "";
    var no = 0;
    $.ajax({
        url: path,
        type: 'GET',
        dataType: "json",
        success: function(data) {
            //console.log($("data").val());
            if ($('#detail tr').length > no) {
                html = $('#detail').html();
                no = $('#detail tr').length;
            }

            no++;
            html += '<tr>' +
                '<td>' + no + '<input type="hidden" name="id_obat' + no + '" class="form-control" value="' +
                data.id + '"></td>' +
                '<td><input type="text" name="nama_obat' + no + '" class="form-control" value="' + data
                .nama_obat + '"></td>' +
                '<td><input type="text" name="jenis_obat' + no + '" class="form-control" value="' + data
                .jenis_obat + '"></td>' +
                '<td><input type="number" name="harga' + no + '" class="form-control" value="' + data
                .harga + '"></td>' +
                '<td>' + '<input type="number" name="qty' + no + '" class="form-control" oninput="sumQty(' +
                no + ',this.value)">' + '</td>' +
                '<td>' +
                '<input type="number" name="sub_total' + no + '" class="form-control" >' +
                '</td>' +
                '<td><a href="#" class="btn btn-sm btn-danger">X</a></td>' +
                '</tr>';
            $('#detail').html(html);
            $("input[name=jml]").val(no);
            sumTotal();
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function sumQty(no, q) {
    var harga = $("input[name=harga" + no + "]").val();
    var subtotal = q * parseInt(harga);
    $("input[name=sub_total" + no + "]").val(subtotal);
    console.log(q + "*" + harga + "=" + subtotal);
    sumTotal();
}

function sumTotal() {
    var total = 0;
    for (let i = 1; i <= $("input[name=jml]").val(); i++) {
        var sub = $("input[name=sub_total" + i + "]").val();
        total = total + parseInt(sub);
    }
    console.log("Total: " + total); // Menambahkan console log untuk total
    $("input[name=total]").val(total);
}
</script>

@endsection