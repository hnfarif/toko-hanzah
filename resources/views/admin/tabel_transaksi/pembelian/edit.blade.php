@extends('template_admin.layout')


@section('tabel', 'active show')
@section('transaksi', 'active show')
@section('pembelian', 'active show')
@section('content')



<div class="content">

    <h1>Edit Tabel Pembelian</h1>


    <a href="{{ '/pembelian' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-arrow-left-bold mr-1"></i>
        Kembali </a>

    <div class="row mt-3">

        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Form Edit Pembelian</h2>
                </div>
                <div class="card-body">
                    <form action="{{ 'update' }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3 ui-menu ui-menu-item">
                                <label>Nama Barang</label>
                                <input type="text"
                                    class="form-control barang @error('nama_barang') is-invalid @enderror"
                                    autocomplete="off" value="{{ $pembelian->nama_barang }}" name="nama_barang"
                                    id="nama_barang" readonly>
                                @error('nama_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3 ui-menu ui-menu-item">
                                <label>Nama Toko</label>
                                <input type="text" class="form-control @error('nama_toko') is-invalid @enderror"
                                    autocomplete="off" value="{{ $pembelian->nama_toko }}" name="nama_toko"
                                    id="nama_toko">
                                @error('nama_toko')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Tanggal Beli</label>
                                <input type="date"
                                    class="form-control datePicker @error('tanggal_beli') is-invalid @enderror"
                                    autocomplete="off" value="{{ $pembelian->tanggal_beli }}" name="tanggal_beli">
                                @error('tanggal_beli')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-ms-4">
                                <label for="validationServer03">Jumlah</label>
                                <div class="input-group ">
                                    <input type="number" class="form-control stok @error('jumlah') is-invalid @enderror"
                                        autocomplete="off" min="0" value="{{ $pembelian->jumlah }}" name="jumlah">
                                    @error('stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append position-relative">
                                        <select name="satuan" class="form-control" id="s_satuan">
                                            @foreach ($satuan as $item)
                                            <option value="{{ $item->nama_satuan }}">{{ $item->nama_satuan }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-ms-4 mb-3" id="ifSatuanShow" @if($pembelian->jumlah_pcs)
                                @else hidden="hidden" @endif>
                                <label for="" id="lbl_satuan">Jumlah pcs/(pack/renceng) (opsional)</label>
                                <input type="number" min="0" class="form-control" name="jml"
                                    value="{{ $pembelian->jumlah_pcs }}">
                            </div>
                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Harga/satuan</label>
                                <input type="number" min="0"
                                    class="form-control harga @error('harga_satuan') is-invalid @enderror"
                                    id="validationServer05" value="{{ $pembelian->harga_satuan }}" name="harga_satuan">
                                @error('harga_satuan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Total Harga</label>
                                <input type="number"
                                    class="form-control total @error('total') is-invalid @enderror"" id="
                                    validationServer05" required readonly name="total">
                                @error('total')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Ubah">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {


        // var now = new Date();

        // var day = ("0" + now.getDate()).slice(-2);
        // var month = ("0" + (now.getMonth() + 1)).slice(-2);

        // var today = now.getFullYear() + "-" + (month) + "-" + (day);

        // $('.datePicker').val(today);

        $("#s_satuan").change(function () {
            let selected_option = $('#s_satuan').val();

            if (selected_option === 'pack' || selected_option === 'renceng') {
                $('#ifSatuanShow').removeAttr('hidden');
            } else {
                $('#ifSatuanShow').attr('hidden', 'hidden');
            }


        });

        let stok = $('.stok').val();
        let harga = $('.harga').val();
        let total = stok * harga;


        if (stok != null && harga != null) {
            $('.total').val(total);
        }

        $('.harga').keyup(function () {
            let stok = $('.stok').val();
            let harga = $('.harga').val();

            let total = stok * harga;

            $('.total').val(total);
        })

        $('.stok').keyup(function () {
            let stok = $('.stok').val();
            let harga = $('.harga').val();

            let total = stok * harga;

            $('.total').val(total);
        })

        var barang = [];
        var pemasok = [];

        $.ajax({

            url: '/pembelian/input/searchbarang',
            method: 'GET',
            async: false,
            success: function (data) {
                data.forEach(element => {
                    barang.push(element['nama_barang']);
                });
            }
        });

        $('#nama_barang').autocomplete({

            source: barang
        });

        $.ajax({

            url: '/pembelian/input/searchtoko',
            method: 'GET',
            async: false,
            success: function (data) {
                data.forEach(element => {
                    pemasok.push(element['nama_pemasok']);
                });
            }
        });

        $('#nama_toko').autocomplete({

            source: pemasok
        });




    });

</script>
@endsection
