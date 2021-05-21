@extends('template_admin.layout')


@section('tabel', 'active show')
@section('transaksi', 'active show')
@section('penjualan', 'active show')
@section('content')

<style>
    .ui-menu .ui-menu-item a {
        background: red;
        height: 10px;
        font-size: 8px;
    }

</style>

<div class="content">

    <h1>Input Tabel Penjualan</h1>


    <a href="{{ '/penjualan' }}" type="button" class="mb-1 btn btn-primary mt-5 text-white">
        <i class=" mdi mdi-arrow-left-bold mr-1"></i>
        Kembali </a>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Form Ubah Penjualan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ 'update' }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3 ui-menu ui-menu-item">
                                <label>Nama Pelanggan</label>
                                <input type="text"
                                    class="form-control barang @error('nama_pelanggan') is-invalid @enderror"
                                    autocomplete="off" value="{{ $penjualan->nama_pelanggan }}" name="nama_pelanggan"
                                    id="nama_pelanggan">
                                @error('nama_pelanggan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3 ui-menu ui-menu-item">
                                <label>Nama Barang</label>
                                <input type="text"
                                    class="form-control nm-brg @error('nama_barang') is-invalid @enderror"
                                    autocomplete="off" value="{{ $penjualan->nama_barang }}" name="nama_barang"
                                    id="nama_barang">
                                @error('nama_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label>Tanggal</label>
                                <input type="date"
                                    class="form-control datePicker @error('tanggal') is-invalid @enderror"
                                    autocomplete="off" value="{{ $penjualan->tanggal }}" name="tanggal">
                                @error('tanggal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-ms-4">
                                <label for="validationServer03">Jumlah</label>
                                <div class="input-group ">
                                    <input type="number" class="form-control stok @error('jumlah') is-invalid @enderror"
                                        autocomplete="off" min="0" value="{{ $penjualan->jumlah }}" name="jumlah">
                                    @error('stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group-append position-relative">
                                        <select name="satuan" class="form-control" id="s_satuan">

                                            <option value="{{ $penjualan->satuan}}">{{ $penjualan->satuan }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-ms-4 mb-3">
                                <label for="validationServer05">Harga/satuan</label>
                                <input type="number" min="0"
                                    class="form-control harga @error('harga_satuan') is-invalid @enderror" id="harga"
                                    value="{{ $penjualan->harga_satuan }}" name="harga_satuan" readonly>
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
        var pelanggan = [];

        $.ajax({

            url: '/penjualan/input/searchbarang',
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

            url: '/penjualan/input/searchpelanggan',
            method: 'GET',
            async: false,
            success: function (data) {
                data.forEach(element => {
                    pelanggan.push(element['nama_pelanggan']);
                });
            }
        });

        $('#nama_pelanggan').autocomplete({

            source: pelanggan
        });

        $(".nm-brg").change(function () {

            let namaBarang = $('.nm-brg').val();

            $.ajax({

                url: '/penjualan/input/getHarga',
                method: 'GET',
                async: false,
                data: {
                    'nama_barang': namaBarang
                },
                success: function (data) {
                    $("#harga").val(data.hargaJual);
                }
            });
        });








    });

</script>
@endsection
